<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Slim\App;
use Slim\Container;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Uri;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

require "../vendor/autoload.php";

// Define Settings
$settings = [
        "settings" => [
                "displayErrorDetails" => "true",
                "logger"              => [
                        "name"  => "slimexample-logger",
                        "path"  => "../logs/app.log",
                        "level" => Logger::DEBUG
                ],
                "view"                => [
                        "templates"   => "../templates",
                        "cache"       => "../templates_c",
                        "auto_reload" => true
                ]
        ]
];

// Create app using the provided settings
$app = new App($settings);

// Set up dependencies
$container = $app->getContainer();

$container["logger"] = function (Container $c) {
    $loggerSettings = $c->get("settings")["logger"];
    $logger = new Logger($loggerSettings["name"]);
    $fileHandler = new StreamHandler($loggerSettings["path"], $loggerSettings["level"]);
    $logger->pushHandler($fileHandler);
    return $logger;
};
$container->logger->info("Logger service registered");

$container["view"] = function (Container $c) {
    $viewSettings = $c->get("settings")["view"];
    $view = new Twig($viewSettings["templates"], [
            "cache"       => $viewSettings["cache"],
            "auto_reload" => $viewSettings["auto_reload"]
    ]);
    $router = $c->get("router");
    $uri = Uri::createFromEnvironment(new Environment($_SERVER));
    $view->addExtension(new TwigExtension($router, $uri));
    return $view;
};
$container->logger->info("Template/View service registered");

// Create routes
$app->get("/", function (Request $request, Response $response, array $args) {
    return $this->view->render($response, "form.html.twig");
});

$app->get("/{placeholder}[/]", function (Request $request, Response $response, array $args) {
    return $this->view->render($response, "form.html.twig", ["placeholder" => $args["placeholder"]]);
});

$app->post("/", function (Request $request, Response $response, array $args) {
    $name = $request->getParsedBodyParam("name");
    return $this->view->render($response, "result.html.twig", ["name" => $name]);
})->setName("result");

// Run the app
$app->run();
