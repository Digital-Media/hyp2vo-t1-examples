<?php
/**
 * Displays the main page.
 *
 * If the user is logged in, the page is shown, if not, the use is redirected back
 * to the login page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2018
 */

use LoginExample\Index;
use LoginExample\Utilities;

session_start();
require_once("src/defines.inc.php");
require_once UTILITIES;
require_once SMARTY;
require_once TNORMFORM;
require_once("src/Index.php");

// Protect the page against unauthorized access
if (!isset($_SESSION[IS_LOGGED_IN]) || $_SESSION[IS_LOGGED_IN] !== Utilities::generateLoginHash()) {
    View::redirectTo("login.php");
}

// Creates a new View object and triggers the NormForm process
$view = new View("indexMain.tpl");

// Creates a new Index object and triggers the NormForm process
$index = new Index($view);
$index->normForm();
