<?php

namespace graphql\types;

use GraphQL\Type\Definition\InputObjectType;
use graphql\Types;

class InputCatType extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'name' => ['type' =>(Types::string())],
                    'picture' => ['type' => Types::string()],
                    'owner_id' => ['type' =>   Types::notNull(Types::id())]
                ];
            }
        ];

        parent::__construct($config);
    }
}