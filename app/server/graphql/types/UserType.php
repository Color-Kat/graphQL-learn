<?php

namespace graphql\types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use graphql\Types;
use src\Db;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => 'user',
            'fields' => function () {
                return [
                    'id' => ['type' => Types::id()],
                    'email' => ['type' => Types::email()],
                    'name' => ['type' => Types::string()],
                    'money' => ['type' => Types::int()],
                    'cats' => [
                        'type' => Types::listOf(Types::u_cat()),
                        'resolve' => function ($root) {
                            try {
                                $result =  Db::query('SELECT * FROM u_cats WHERE owner_id = :owner_id', ['owner_id' => $root['id']]);

                                return !empty($result) ? $result : [];
                            } catch (\Throwable $e) {
                                echo $e->getMessage();
                            }
                        }
                    ],
                    'reg_date' => ['type' => Types::string()],
                ];
            }
        ];

        parent::__construct($config);
    }
}
