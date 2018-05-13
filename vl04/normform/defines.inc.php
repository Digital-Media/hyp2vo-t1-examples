<?php
/**
 * This file holds all global constants that are used throughout the PHPUE application.
 *
 * All global constants that are needed on the various pages are stored here.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */
/**
 * Activate Debugging-Messages here for easier testing
 */
define ('DEBUG',false);
if (DEBUG) {
    echo "<br>WARNING: Debugging is enabled. Set DEBUG to false for production use in " . __FILE__;
    echo "<br>Connect via SSH and send tail -f /var/log/apache2/error.log";
    echo " to see errors not displayed in Browser<br><br>";
    error_reporting(E_ALL);
    ini_set('html_errors', '1');
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
}
// Path and file definitions

/**
 * @var string NORM_DIR The Path to the NormForm library.
 */
define("SMARTY", "vendor/smarty/smarty/libs/Smarty.class.php");

/**
 * @var string NORM_DIR The Path to the NormForm library.
 */
define("NORM_DIR", "vendor/normform/");

/**
 * @var string NORM_FORM Path to the NormForm class.
 */
define("TNORMFORM", NORM_DIR . "AbstractNormForm.php");

/**
 * @var string CSS_DIR Path to the CSS files provided by NormForm.
 */
define("CSS_DIR", "css");