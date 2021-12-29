<?php

require_once('vendor/autoload.php');
require('./bootstrap.php');

session_start();

use GraphQL\Error\FormattedError;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use graphql\Types;
use src\Db;

const IS_DEV = true;

Db::connectDb();

$schema = new Schema([
    'query' => Types::query(),
    'mutation' => Types::mutation()
]);

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
$query = $input['query'];
$variable = $input['variables'] ?? [];

try {
    $myErrorFormatter = function(\GraphQL\Error\Error $error) {
        return FormattedError::createFromException($error);
    };

    $myErrorHandler = function(array $errors, callable $formatter) {
        return array_map($formatter, $errors);
    };

    $result = GraphQL::executeQuery($schema, $query, null, null, $variable)
        ->setErrorFormatter($myErrorFormatter)
        ->setErrorsHandler($myErrorHandler);
    $output = $result->toArray();
} catch (\graphql\SaveException $e) {
    $output = [
        'errors' => [
            [
                'message' => $e->getMessage()
            ]
        ]
    ];
}
header('Content-Type: application/json');
echo json_encode($output);