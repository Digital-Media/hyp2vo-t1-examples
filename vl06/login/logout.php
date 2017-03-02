<?php

/**
 * Logout-Seite zum PHP-basierten Login-Mechanismus.
 *
 * In dieser Datei wird ein Logout durchgeführt. Dabei wird zunächst die Session fortgeführt, dann das Session-Array gelöscht, das
 * Session-Cookie überschrieben (und damit gelöscht) und schließlich die Session logisch am Server zerstört. Danach wird auf die
 * Login-Seite weitergeleitet.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */

session_start();

require_once("defines.inc.php");

$_SESSION = [];
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), "", time() - 86400, "/");
}

session_destroy();

header(FORWARD_LOGINFORM);