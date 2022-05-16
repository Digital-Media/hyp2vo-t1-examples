<?php

declare(strict_types=1);

use Fhooe\Router\Router;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use RestApiExample\CreateDB;
use RestApiExample\UserManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

require "../vendor/autoload.php";

/**
 * When working with sessions, start them here.
 */
//session_start();

/**
 * Instantiated Router invocation. Create an object, define the routes and run it.
 */
// Create a new Router object.
$router = new Router();

// Create a monolog instance for logging in the skeleton. Pass it to the router to receive its log messages too.
$logger = new Logger("skeleton-logger");
$logger->pushHandler(new StreamHandler(__DIR__ . "/../logs/router.log"));
$router->setLogger($logger);

// Create a new twig instance for advanced templates.
$twig = new Environment(
    new FilesystemLoader("../views"),
    [
        "cache" => "../cache",
        "auto_reload" => true,
        "debug" => true
    ]
);
$twig->addFunction(new TwigFunction("url_for", [Router::class, "urlFor"]));
$twig->addFunction(new TwigFunction("get_base_path", [Router::class, "getBasePath"]));
$twig->addExtension(new DebugExtension());

if (isset($_SESSION)) {
    $twig->addGlobal("_session", $_SESSION);
}

// Set a base path if your code is not in your server's document root.
$router->setBasePath("/code/hyp2vo-t1-examples/vl10/rest-api/public");

// Set a 404 callback that is executed when no route matches.
// Example for the use of an arrow function. It automatically includes variables from the parent scope (such as $twig).
$router->set404Callback(fn() => $twig->display("404.html.twig"));

// Define all routes here.
$router->get("/", function () use ($twig) {
    $twig->display("index.html.twig");
});

$router->get("/users", function () {
    $userManager = new UserManager();

    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    if ($id) {
        $userManager->listUser($id);
    } else {
        $userManager->listUsers();
    }
});

$router->post("/users", function () {
    $userManager = new UserManager();
    $userManager->addUser();
});

$router->get("/adduser", function () use ($twig) {
    $twig->display("adduser.html.twig");
});

$router->get("/createdb", function () use ($twig) {
    $createDB = new CreateDB($twig);
    $createDB->createSchema();
    $createDB->createTable();
    $createDB->addUsers();
    $createDB->displayOutput();
});

// Run the router to get the party started.
$router->run();
