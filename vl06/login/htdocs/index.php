<?php

/**
 * Displays the main page.
 *
 * If the user is logged in, the page is shown, if not, the use is redirected back to the login page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2020
 */

use Fhooe\NormForm\View\View;
use LoginExample\Index;
use LoginExample\Utilities;

require "../vendor/autoload.php";
require "../src/defines.inc.php";

session_start();

// Protect the page against unauthorized access
if (!isset($_SESSION[IS_LOGGED_IN]) || $_SESSION[IS_LOGGED_IN] !== Utilities::generateLoginHash()) {
    View::redirectTo("login.php");
}

$view = new View(
    "index.html.twig",
    "../templates",
    "../templates_c",
);

$index = new Index($view);
$index->normForm();
