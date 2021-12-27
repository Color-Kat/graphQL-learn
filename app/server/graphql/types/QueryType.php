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
                    'cats' => [
                        'type' => Types::cat(),
                        'description' => 'get of pagination cats from table `cats`',
                        'args' => [
                            'page' => Types::int(),
                            'count' => Types::int()
                        ],
                        'resolve' => function($root, $args) {
                            $page = $args['page'] ?? 1;
                            $count = $args['count'] ?? 2;

                            $start = ($page-1) * $count;
                            $end = $start +  $count;

                            return Db::query("SELECT * FROM cats LIMIT $start, $end")[0];
                        }
                    ],
                    'user'  => [
                        'type'    => Types::user(),
                        'description' => 'get user data by id',
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