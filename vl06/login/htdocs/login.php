<?php

/**
 * Performs a login.
 *
 * If the user is not logged in the page is shown and the login can proceed.
 * If the user is logged in, there will be a redirect back to the index page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2020
 */

use Fhooe\NormForm\Parameter\GenericParameter;
use Fhooe\NormForm\Parameter\PostParameter;
use Fhooe\NormForm\View\View;
use LoginExample\Login;
use LoginExample\Utilities;

require "../vendor/autoload.php";
require "../src/defines.inc.php";

session_start();

// Send users to the main page if they are already logged in
if (isset($_SESSION[IS_LOGGED_IN]) && $_SESSION[IS_LOGGED_IN] === Utilities::generateLoginHash()) {
    View::redirectTo("index.php");
}

$view = new View(
    "login.html.twig",
    "../templates",
    "../templates_c",
    [
        new PostParameter(Login::USERNAME),
        new GenericParameter("passwordName", Login::PASSWORD)
    ]
);

$login = new Login($view);
$login->normForm();
