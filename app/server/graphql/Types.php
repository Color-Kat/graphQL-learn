<?php

namespace graphql;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use graphql\types\CatType;
use graphql\types\UserCatType;
use graphql\types\mutation\InputCatType;
use graphql\types\mutation\InputUserType;
use graphql\types\mutation\MutationType;
use graphql\types\QueryType;
use graphql\types\scalar\EmailType;
use graphql\types\UserType;

class Types
{
    /**
     * @var QueryType GraphQL query
     */
    private static $query;

    public static function query(): QueryType
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    /**
     * @var MutationType GraphQL mutation
     */
    private static $mutation;

    public static function mutation(): MutationType
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }

    /**
     * @var UserType type of user in table users
     */
    private static $user;

    public static function user(): UserType
    {
        return self::$user ?: (self::$user = new UserType());
    }

    /**
     * @var InputUserType type of input user fields for registration
     */
    private static $inputUser;

    public static function inputUser()
    {
        return self::$inputUser ?: (self::$inputUser = new InputUserType());
    }

    /**
     * @var CatType type of cat in table cats
     */
    private static $cat;

    public static function cat(): CatType{
        return self::$cat ?: (self::$cat = new CatType());
    }

    /**
     * @var InputCatType type of input cat fields for create cats
     */
    private static $inputCat;

    public static function inputCat()
    {
        return self::$inputCat ?: (self::$inputCat = new InputCatType());
    }

    /**
     * @var UserCatType type of bought cat in u_cats table
     */
    private static $u_cat;

    public static function u_cat(): UserCatType
    {
        return self::$u_cat ?: (self::$u_cat = new UserCatType());
    }

    /**
     * @var ScalarType scalar type of Email pattern
     */
    private static $email;

    public static function email(): ScalarType
    {
        return self::$email ?: (self::$email = new EmailType());
    }

    public static function string(): ScalarType
    {
        return Type::string();
    }

    public static function int(): ScalarType
    {
        return Type::int();
    }

    public static function id(): ScalarType
    {
        return Type::id();
    }

    public static function notNull($type): NonNull
    {
        return Type::nonNull($type);
    }

    public static function listOf($type): ListOfType
    {
        return Type::listOf($type);
    }
}