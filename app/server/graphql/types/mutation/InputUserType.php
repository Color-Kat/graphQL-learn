<?php

namespace graphql\types\mutation;

use GraphQL\Type\Definition\InputObjectType;
use graphql\Types;

class InputUserType extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'name'     => Types::notNull(Types::string()),
                    'password' => Types::notNull(Types::string()),
                    'email'    => Types::notNull(Types::email()),
                    'money'    => Types::int(),
                ];
            }
        ];

        parent::__construct($config);
    }
}