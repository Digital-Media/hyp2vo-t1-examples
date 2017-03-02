<?php

/**
 * Konstanten zum PHP-basierten Login-Mechanismus.
 *
 * In dieser Datei werden Konstanten definiert, die für den PHP-basierten Login-Mechanismus nötig sind. Dies betrifft Konstanten,
 * die in der Session verwendet werden, aber auch Konstanten die für die Weiterleitung mittels header() Verwendung finden.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */

/**
 * Konstante zur Speicherung der Login-Informationen in der Session.
 */
define("LOGIN", "login");

/**
 * Konstante zur Speicherung des Benutzernamens in der Session.
 */
define("USERNAME", "username");

/**
 * Konstante zur Speicherung des Forward-Zieles in Richtung Login-Seite.
 */
define("FORWARD_LOGINFORM", "Location: login.php");

/**
 * Konstante zur Speicherung des Forward-Zieles in Richtung Hauptseite.
 */
define("FORWARD_INDEX", "Location: index.php");