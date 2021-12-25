<?php

namespace graphql;

use GraphQL\Type\Definition\Type;
use graphql\types\UserType;

class Types{
    private static $user;

    public static function user(){
        return self::$user ?: (self::$user = new UserType());
    }

    public static function string(){
        return Type::string();
    }
}