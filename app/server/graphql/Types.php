<?php

namespace graphql;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use graphql\types\CatType;
use graphql\types\MutationType;
use graphql\types\QueryType;
use graphql\types\UserType;

class Types{
    private static $query;
    private static $mutation;

    private static $user;
    private static $cat;

    public static function query(): QueryType{
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function mutation(): MutationType{
        return self::$mutation ?: (self::$mutation = new MutationType());
    }

    public static function user(): UserType{
        return self::$user ?: (self::$user = new UserType());
    }

    public static function cat(): CatType{
        return self::$cat ?: (self::$cat = new CatType());
    }

    public static function string(): ScalarType{
        return Type::string();
    }

    public static function int(): ScalarType
    {
        return Type::int();
    }

    public static function id(): ScalarType{
        return Type::id();
    }

    public static function listOf($type): ListOfType
    {
        return Type::listOf($type);
    }
}