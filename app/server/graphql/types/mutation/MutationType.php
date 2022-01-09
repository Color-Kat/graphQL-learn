<?php

namespace graphql\types\mutation;

use GraphQL\Error\Error;
use graphql\SaveException;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use graphql\Types;
use src\Db;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'register' => [
                        'type'        => Types::user(),
                        'description' => 'Register new user',
                        'args'        => [
                            'user' => Types::inputUser()
                        ],
                        'resolve' => function ($root, $args) {
                            $params = [
                                'name' => $args['user']['name'],
                                'password' => password_hash($args['user']['password'], PASSWORD_BCRYPT),
                                'email' => $args['user']['email']
                            ];

                            try {
                                $id = Db::query(
                                    'INSERT INTO users (name, password, email) 
                                        VALUES (:name, :password, :email)',
                                    $params
                                );
                                $user = Db::query('SELECT * FROM users WHERE id = :id', ['id' => $id])[0];
                            } catch (\Exception $e) {
                                throw new SaveException('Произошла какая-то ошибка');
                            }

                            if (is_null($user)) throw new SaveException('Нет пользователя с таким id');
                            return $user;
                        }
                    ],
                    'login' => [
                        'type' => Types::user(),
                        'description' => 'login user and save auth in session',
                        'args' => [
                            'email' => Types::email(),
                            'password' => Types::string()
                        ],
                        'resolve' => function ($root, $args, $null, $resolverInfo) {
                            // user is already logged in
                            if (isAuth()) {
                                throw new SaveException('Вы уже авторизованны!');
                            }

                            // $selectedFields = $resolverInfo->getFieldSelection();
                            // $selectedFields['password'] = 1; // add password to query
                            // $selectedFields['id'] = 1; // add password to query
                            // $selectedFields = implode(", ", array_keys($selectedFields));


                            $user = Db::query(
                                "SELECT * FROM users WHERE email = :email",
                                ['email' => $args['email']]
                            )[0];

                            if (empty($user))
                                throw new SaveException("Такого пользователя не существует");

                            if (!password_verify($args['password'], $user['password']))
                                throw new SaveException("Неверный пароль");

                            $_SESSION['auth'] = true;
                            $_SESSION['user_id'] = $user['id'];

                            return $user;
                        }
                    ],
                    'logout' => [
                        'type' => Types::boolean(),
                        'description' => 'do log out by session removing',
                        'resolve' => function () {
                            unset($_SESSION['auth']);
                            unset($_SESSION['user_id']);
                            return true;
                        }
                    ],
                    'createCat'  => [
                        'type'    => Types::cat(),
                        'description' => 'create new cat in table cats',
                        'args'    => [
                            'cat' => Types::inputCat()
                        ],
                        'resolve' => function ($root, $args) {
                            $id = Db::query('INSERT INTO cats (name, owner_id) VALUES (:name, :owner_id)', ['name' => $args['cat']['name'], 'owner_id' => $args['cat']['owner_id']]);
                            return Db::query('SELECT * FROM cats WHERE id = :id', ['id' => $id])[0];
                        }
                    ],
                    'buyCat' => [
                        'type' => Types::boolean(),
                        'description' => 'add cat in u_cats table, decrease money of user',
                        'args' => [
                            'cat_id' => Types::notNull(Types::int()),
                            'name' => Types::string()
                        ],
                        'resolve' => function ($root, $args) {
                            if (!isAuth()) return false;

                            $user_id = $_SESSION['user_id'];

                            // get user's balance
                            $user_money = Db::query(
                                "SELECT money FROM users WHERE id = :user_id",
                                ['user_id' => $user_id]
                            )[0]['money'];

                            // get cat from db by id
                            $cat = Db::query("SELECT * FROM cats WHERE id = :cat_id", ['cat_id' => $args['cat_id']])[0];

                            // not enough money
                            if ($user_money < $cat['price']) return false;

                            try {
                                // decrease user's money
                                Db::query("UPDATE users SET money = :money WHERE id = :user_id", [
                                    'money' => ($user_money - $cat['price']),
                                    'user_id' => $user_id
                                ]);

                                // add new cat to u_cats table
                                $cat_name = $args['name'] ?? $cat['name'];
                                Db::query("INSERT u_cats (name, dna, owner_id) 
                                            VALUES (:name, :dna, :owner_id)", [
                                    'name' => $cat_name,
                                    'dna' => $cat['dna'],
                                    'owner_id' => $user_id
                                ]);

                                // delete cat from store (cats table)
                                Db::query("DELETE FROM cats WHERE id=:cat_id", ['cat_id' => $args['cat_id']]);

                                return true;
                            } catch (\Exception $e) {
                                throw new SaveException('Произошла какая-то ошибка: ' . $e->getMessage());
                            }
                        }
                    ]
                    //                    'matingCats' => [
                    //                        'type' => Types::u_cat(),
                    //                        'description' => 'create new cats by ids of 2 parent cats. New cats have new DNA and the same owner',
                    //                        'args' => [
                    //                            'id_1' => Types::id(),
                    //                            'id_2' => Types::id()
                    //                        ],
                    //                        'resolve' => function($root, $args){
                    //
                    //                        }
                    //                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}
