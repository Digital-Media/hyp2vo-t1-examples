<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require "../vendor/autoload.php";

$app = new App();
$app->get("/", function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World!");
    return $response;
});

$app->run();
