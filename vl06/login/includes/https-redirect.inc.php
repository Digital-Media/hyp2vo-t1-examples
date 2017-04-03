<?php

/**
 * Performs a PHP-based redirect from HTTP to HTTPS.
 *
 * This snippet checks which protocol is currently being used. If HTTP is employed, a redirect using header() is used
 * to forward to the same host and script name but on HTTPS. This is a simple solution meant to be used in exercises.
 * In production environments, redirects should be done by the webserver.
 * @see http://www.sysadminslife.com/linux/quicktipp-weiterleitung-redirect-von-http-auf-https-via-apache-oder-htaccess/
 * More information on Apache redirects.
 * Please be aware that XAMPP uses a self-signed certificate which your browser will warn you about. If you are having
 * troubles with your HTTPS configuration, simple do not include this file.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */

if (!isset($_SERVER["HTTPS"]) || strcmp($_SERVER["HTTPS"], "off") === 0) {
    // A 301 status header can be set to signal search engines that they should permanently use the new target
    header("HTTP/1.1 301 Moved Permanently"); // Optional
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
    exit();
}
