<?php
/**
 * This file holds all global constants that are used throughout in this login application.
 *
 * All global constants that are needed on the various pages are stored here.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */

// Path and file definitions

/**
 * @var string NORM_DIR The Path to the NormForm library.
 */
define("NORM_DIR", "vendor/normform/");

/**
 * @var string NORM_FORM Path to the abstract NormForm base class.
 */
define("NORM_FORM", NORM_DIR . "AbstractNormForm.php");

/**
 * @var string HTTPS_REDIRECT Path to the HTTPS redirect include.
 */
define("HTTPS_REDIRECT", "includes/https-redirect.inc.php");

/**
 * @var string LOGIN_SYSTEM Path to the LoginSystem class.
 */
define("LOGIN_SYSTEM", "includes/LoginSystem.php");

/**
 * @var string FILE_ACCESS Path to the FileAccess class.
 */
define("FILE_ACCESS", "includes/FileAccess.php");


// Session fields

/**
 * @var string USERNAME Key for the session field that holds the currently logged in username.
 */
define("USERNAME", "username");

/**
 * @var string IS_LOGGED_IN Key for the session field which remembers that a user is currently logged in.
 */
define("IS_LOGGED_IN", "is_logged_in");


// Protected pages and header forwards

/**
 * @var array PROTECTED_PAGES Array with pages that are protected through the login mechanism.
 */
define("PROTECTED_PAGES", ["index.php"]);

/**
 * @var string INDEX Forward to the index page.
 */
define("INDEX", "index.php");

/**
 * @var string LOGIN Forward to the login page.
 */
define("LOGIN", "login.php");

/**
 * @var string LOGOUT Forward to the logout page.
 */
define("LOGOUT", "logout.php");
