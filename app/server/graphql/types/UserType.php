<?php

namespace graphql\types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use src\Db;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'getUserName' => [
                        'type'    => Type::string(),
                        'resolve' => function () {
                            return Db::query('SELECT name FROM users WHERE id = 1')[0]['name'];
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}