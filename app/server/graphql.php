<?php

require_once('vendor/autoload.php');
require('./bootstrap.php');

cors();

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
    $myErrorFormatter = function (\GraphQL\Error\Error $error) {
        return FormattedError::createFromException($error);
    };

    $myErrorHandler = function (array $errors, callable $formatter) {
        return array_map($formatter, $errors);
    };

    $result = GraphQL::executeQuery($schema, $query, null, null, $variable)
        ->setErrorFormatter($myErrorFormatter)
        ->setErrorsHandler($myErrorHandler);
    $output = $result->toArray();
} catch (\Throwable $e) {
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

function cors()
{
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}
