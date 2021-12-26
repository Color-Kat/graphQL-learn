<?php

namespace graphql\types;

use GraphQL\Type\Definition\ObjectType;
use graphql\Types;
use src\Db;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'createCat' => [
                        'type'       => Types::cat(),
                        'args'       => [
                            'cat' => Types::inputCat()
                        ],
                        'resolve' => function ($root, $args) {
                            $id = Db::query('INSERT INTO cats (name, owner_id) VALUES (:name, :owner_id)', ['name' => $args['cat']['name'], 'owner_id' => $args['cat']['owner_id']]);
                            return Db::query('SELECT * FROM cats WHERE id = :id', ['id' => $id])[0];
                        }
                    ]
                ];
            }
        ];

        parent::__construct($config);
    }
}