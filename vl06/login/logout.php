<?php
/**
 * Destroys a session and performs a logout for the current user.
 *
 * The session is first continued then the superglobal S_SESSION is emptied. The session cookie is then invalidated and
 * the call to session_destroy() is issued. After that the system redirects to the LOGIN page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */

session_start();

require_once("includes/defines.inc.php");

require_once LOGIN_SYSTEM;

$_SESSION = [];
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time() - 86400, "/");
}
session_destroy();

LoginSystem::redirectTo(LOGIN);
