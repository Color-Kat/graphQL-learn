<?php

namespace graphql;

use GraphQL\Error\ClientAware;

class SaveException extends \Exception implements ClientAware
{
    public function isClientSafe(): bool
    {
        return true;
    }

    public function getCategory(): string
    {
        return 'Internal error';
    }
}