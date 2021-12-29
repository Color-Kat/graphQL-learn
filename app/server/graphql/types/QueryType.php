<?php

namespace graphql\types;

use graphql\SaveException;
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
                        'resolve' => function($root, $args, $a, $resolverInfo){
                            $selectedFields = implode(", ", array_keys($resolverInfo->getFieldSelection()));
                            return Db::query("SELECT $selectedFields FROM users");
                        }
                    ],
                    'user'  => [
                        'type'    => Types::user(),
                        'description' => 'get user data by id',
                        'args'    => [
                            'id' => Types::id()
                        ],
                        'resolve' => function ($root, $args, $a, $resolverInfo) {
                            $selectedFields = implode(", ", array_keys($resolverInfo->getFieldSelection()));
                            return Db::query('SELECT $selectedFields FROM users WHERE id = :id', ['id' => $args['id']])[0];
                        }
                    ],
                    'isAuth' => [
                        'type' => Types::boolean(),
                        'description' => 'return true if user is logged in and return false if dont',
                        'resolve' => function(){
                            return isset($_SESSION['auth']) && $_SESSION['auth'];
                        }
                    ],
                    'cats' => [
                        'type' => Types::listOf(Types::cat()),
                        'description' => 'get of pagination cats from table `cats`',
                        'args' => [
                            'page' => Types::int(),
                            'count' => Types::int()
                        ],
                        'resolve' => function($root, $args, $a, $resolverInfo) {
                            $page = $args['page'] ?? 1;
                            $count = $args['count'] ?? 5;

                            $start = ($page-1) * $count;
                            $end = $start +  $count;

                            $selectedFields = implode(", ", array_keys($resolverInfo->getFieldSelection()));

                            $result = Db::query("SELECT $selectedFields FROM cats LIMIT $start, $end");

                            return !empty($result) ? $result : null;
                        }
                    ],
                ];
            }
        ];

        parent::__construct($config);
    }
}