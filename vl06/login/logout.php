<?php
/**
 * Destroys a session and performs a logout for the current user.
 *
 * The session is first continued then the superglobal S_SESSION is emptied. The session cookie is then invalidated and
 * the call to session_destroy() is issued. After that the system redirects to the LOGIN page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2018
 */

session_start();

require_once("src/defines.inc.php");
require_once TNORMFORM;

$_SESSION = [];
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time() - 86400, "/");
}
session_destroy();

View::redirectTo("login.php");
