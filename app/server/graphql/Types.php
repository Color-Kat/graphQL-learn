<?php

namespace graphql;

use GraphQL\Type\Definition\Type;
use graphql\types\CatType;
use graphql\types\QueryType;
use graphql\types\UserType;

class Types{
    private static $user;
    private static $query;
    private static $cat;

    public static function query(){
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function user(){
        return self::$user ?: (self::$user = new UserType());
    }

    public static function cat(){
        return self::$cat ?: (self::$cat = new CatType());
    }

    public static function string(){
        return Type::string();
    }

    public static function int()
    {
        return Type::int();
    }

    public static function listOf($type)
    {
        return Type::listOf($type);
    }
}