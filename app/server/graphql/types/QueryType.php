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
                    'users' => [
                        'type' => Types::listOf(Types::user()),
                        'resolve' => function(){
                            return Db::query('SELECT * FROM users');
                        }
                    ],
//                    'cats' => [
//                        'type'
//                    ],
                    'user'  => [
                        'type'    => Types::user(),
                        'args'    => [
                            'id' => Types::id()
                        ],
                        'resolve' => function ($root, $args) {
                            return Db::query('SELECT * FROM users WHERE id = :id', ['id' => $args['id']])[0];
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}