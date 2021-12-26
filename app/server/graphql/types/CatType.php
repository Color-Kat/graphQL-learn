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
                    'id' => Types::int(),
                    'name' => Types::string(),
                    'owner_id' => Types::int()
                ];
            }
        ];

        parent::__construct($config);
    }
}