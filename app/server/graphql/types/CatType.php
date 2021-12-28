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

                    'id' => ['type' => Types::notNull(Types::id())],
                    'name' => ['type' => Types::notNull(Types::string())],
                    'dna' => ['type' => Types::notNull(Types::string())],
                    'price' => ['type' => Types::notNull(Types::int())],
                    'birthday' => ['type' => Types::notNull(Types::string())]
                ];
            }
        ];

        parent::__construct($config);
    }
}