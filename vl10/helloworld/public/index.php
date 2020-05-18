<?php

// Error Handling, um Fehlermeldungen zu sehen
define("DEBUG", true);

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set("html_errors", "1");
    ini_set("display_errors", "1");
    ini_set("display_startup_errors", "1");
}

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require "../vendor/autoload.php";

$app = AppFactory::create();

// Derives the base path from the current script name
$basePath = dirname($_SERVER["SCRIPT_NAME"]);
$app->setBasePath($basePath);

$app->get(
    "/",
    function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    }
);

$app->run();
