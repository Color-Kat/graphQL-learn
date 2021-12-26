<?php

namespace graphql\types;

use GraphQL\Type\Definition\ObjectType;
use graphql\Types;
use src\Db;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'hello' => [
                        'type'    => Types::string(),
                        'resolve' => function () {
                            return 123;
                        }
                    ],
                    'user'  => [
                        'type'    => Types::user(),
                        'args'    => [
                            'id' => Types::int()
                        ],
                        'resolve' => function ($root, $args) {
                            $user = Db::query('SELECT * FROM users WHERE id = :id', ['id' => $args['id']])[0];
//                            print_r($user);
                            return $user;
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}