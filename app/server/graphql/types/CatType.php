<?php

namespace graphql\types;

use GraphQL\Type\Definition\ObjectType;
use graphql\Types;

class CatType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function(){
                return [
                    'id' => ['type' => Types::id()],
                    'name' => ['type' => Types::string()],
                    'properties' => ['type' => Types::string()],
                    'price' => ['type' => Types::int()],
                    'birthday' => ['type' => Types::string()]
                ];
            }
        ];

        parent::__construct($config);
    }
}