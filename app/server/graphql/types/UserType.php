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
                    'cats' => [
                        'type' => Types::listOf(Types::cat()),
                        'resolve' => function($root){
                            return Db::query('SELECT * FROM cats WHERE owner_id = :owner_id', ['owner_id' => $root['id']]);
                        }
                    ],
                    'reg_date' => ['type' => Types::string()],
                ];
            }
        ];

        parent::__construct($config);
    }
}