<?php
/**
 * Destroys a session and performs a logout for the current user.
 *
 * The session is first continued then the superglobal $_SESSION is emptied. The session cookie is then invalidated and
 * the call to session_destroy() is issued. After that the system redirects to the login page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2021
 */

use Fhooe\NormForm\View\View;

require "../vendor/autoload.php";

session_start();

$_SESSION = [];

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", ["expires" => time() - 86400, "path" => "/"]);
}

session_destroy();

View::redirectTo("login.php");
