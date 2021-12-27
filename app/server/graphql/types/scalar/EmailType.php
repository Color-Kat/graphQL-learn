<?php

namespace graphql\types\scalar;

class EmailType extends \GraphQL\Type\Definition\ScalarType
{
    public function serialize($value)
    {
        return $value;
    }

    public function parseValue($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Не корректный E-mail');
        }
        return $value;
    }

    public function parseLiteral(\GraphQL\Language\AST\Node $valueNode, ?array $variables = null)
    {
        if (!filter_var($valueNode->value, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Не корректный E-mail');
        }
        return $valueNode->value;
    }
}