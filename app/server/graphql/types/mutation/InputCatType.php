<?php

namespace graphql\types\mutation;

use GraphQL\Type\Definition\InputObjectType;
use graphql\Types;

class InputCatType extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'name' => ['type' =>Types::notNull(Types::string())],
                    'properties' => ['type' => Types::notNull(Types::string())],
                    'prise' => ['type' =>   Types::notNull(Types::int())]
                ];
            }
        ];

        parent::__construct($config);
    }
}