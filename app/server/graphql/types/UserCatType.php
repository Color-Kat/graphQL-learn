<?php

namespace graphql\types;

use GraphQL\Type\Definition\ObjectType;
use graphql\Types;

class UserCatType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function(){
                return [
                    'id' => ['type' => Types::id()],
                    'name' => ['type' => Types::string()],
                    'owner_id' => ['type' => Types::int()],
                    'dna' => ['type' => Types::string()],
                    'birthday' => ['type' => Types::string()]
                ];
            }
        ];

        parent::__construct($config);
    }
}