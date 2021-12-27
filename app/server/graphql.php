<?php

require_once('vendor/autoload.php');

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use graphql\Types;
use src\Db;

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
    $result = GraphQL::executeQuery($schema, $query, null, null, $variable);
    $output = $result->toArray();
} catch (\Exception $e) {
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