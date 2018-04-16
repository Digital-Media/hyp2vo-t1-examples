<?php
/**
 * Performs a login.
 *
 * If the user is not logged in the page is shown and the login can proceed.
 * If the user is logged in, there will be a redirect back to the index page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2018
 */

use LoginExample\Login;
use LoginExample\Utilities;

session_start();
require_once("src/defines.inc.php");
require_once UTILITIES;
require_once SMARTY;
require_once TNORMFORM;
require_once FILE_ACCESS;
require_once("src/Login.php");

// Send users to the main page if they are already logged in
if (isset($_SESSION[IS_LOGGED_IN]) && $_SESSION[IS_LOGGED_IN] === Utilities::generateLoginHash()) {
    View::redirectTo("index.php");
}

// Defines a new view that specifies the template and the parameters that are passed to the template
$view = new View("loginMain.tpl", [
    new PostParameter(Login::USERNAME),
    new GenericParameter("passwordKey", Login::PASSWORD)
]);

// Creates a new Login object and triggers the NormForm process
$login = new Login($view);
$login->normForm();
