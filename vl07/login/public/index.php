<?php

declare(strict_types=1);

use Fhooe\Router\Router;
use Fhooe\Twig\RouterExtension;
use Fhooe\Twig\SessionExtension;
use LoginExample\CreateDB;
use LoginExample\Login;
use LoginExample\PasswordHash;
use LoginExample\RouteGuard;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require "../vendor/autoload.php";

/**
 * When working with sessions, start them here.
 */
session_start();

/**
 * Instantiated Router invocation. Create an object, define the routes and run it.
 */
// Create a new Router object.
$router = new Router();

// Create a monolog instance for logging in the skeleton. Pass it to the router to receive its log messages too.
$logger = new Logger("skeleton-logger");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/router.log"));
$router->setLogger($logger);

// Create a new Twig instance for advanced templates.
$twig = new Environment(
    new FilesystemLoader("../views"),
    [
        "cache" => "../cache",
        "auto_reload" => true,
        "debug" => true
    ]
);

// Add the router extension to Twig. This makes the url_for() and get_base_path() functions available in templates.
$twig->addExtension(new RouterExtension($router));
// Add the session extension to Twig. This makes the session() function available in templates to access entries in $_SESSION.
$twig->addExtension(new SessionExtension());
// Add the debug extension to Twig. This makes the dump() function available in templates to dump variables.
$twig->addExtension(new DebugExtension());

// Set a base path if your code is not in your server's document root.
$router->setBasePath("/hyp2vo-t1-examples/vl07/login/public");

// Set a 404 callback that is executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $twig).
$router->set404Callback(fn() => $twig->display("404.html.twig"));

// Define all routes here.
$router->get("/", function () use ($twig) {
    $twig->display("index.html.twig");
});

$router->get("/login", function () use ($twig, $router) {
    RouteGuard::requireNotLoggedIn($router, "/main");
    $twig->display("login.html.twig");
});

$router->post("/login", function () use ($twig, $router) {
    $login = new Login($twig, $router);
    $login->isValid();
    $login->displayOutput();
});

$router->get("/main", function () use ($twig, $router) {
    RouteGuard::requireLoggedIn($router, "/login");
    $twig->display("main.html.twig");
});

$router->get("/logout", function () use ($router) {
    $_SESSION = [];
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time() - 86400, "/");
    }
    session_destroy();
    $router->redirectTo("/");
});

$router->get("/createdb", function () use ($twig) {
    $createDB = new CreateDB($twig);
    $createDB->createSchema();
    $createDB->createTable();
    $createDB->addUsers();
    $createDB->displayOutput();
});

$router->get("/passwordhash", function () use ($twig) {
    $generatePassword = new PasswordHash($twig);
    $generatePassword->displayOutput();
});

$router->post("/passwordhash", function () use ($twig) {
    $generatePassword = new PasswordHash($twig);
    $generatePassword->displayOutput();
});

// Run the router to get the party started.
$router->run();
