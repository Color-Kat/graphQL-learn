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
                        'resolve' => function($root, $args){
                            $params = [
                                'name' => $args['user']['name'],
                                'password' => password_hash($args['user']['password'], PASSWORD_BCRYPT),
                                'email' => $args['user']['email']
                            ];

                            try{
                                $id = Db::query(
                                    'INSERT INTO users (name, password, email) 
                                        VALUES (:name, :password, :email)',
                                    $params
                                );
                                $user = Db::query('SELECT * FROM users WHERE id = :id', ['id' => $id])[0];
                            }catch(\Exception $e){
                                throw new SaveException('Произошла какая-то ошибка');
                            }

                            if(is_null($user)) throw new SaveException('Нет пользователя с таким id');

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
                        'resolve' => function($root, $args) {
                            $_SESSION['auth'] = true;
                            return ['name'=>'color'];
                        }
                    ],
                    'logout' => [
                        'type' => Types::boolean(),
                        'description' => 'do log out by session removing',
                        'resolve' => function(){
                            unset($_SESSION['auth']);
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