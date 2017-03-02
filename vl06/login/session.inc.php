<?php

/**
 * Absicherungsdatei zum PHP-basierten Login-Mechanismus.
 *
 * In dieser Datei wird überprüft, ob die Session den nach einer erfolgreichen Authentifizierung in login.php gespeicherten
 * Zufallswert enthält. Ist dieser vorhanden und findet sich der Nutzer bzw. die Nutzerin auf der Seite login.php, darf index.php
 * betreten werden. Ist index.php die aktuelle Seite und der Zufallswert ist nicht vorhanden, wird auf login.php geleitet.
 * Darüber hinaus wird noch überprüft, ob die aktuelle Seite per HTTPS betreten wurde. Ist dies nicht der Fall, wird auf HTTPS
 * umgeleitet.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */

session_start();

require_once("defines.inc.php");

if (!isset($_SERVER["HTTPS"]) || strcmp($_SERVER["HTTPS"], "off") === 0) {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"]);
}

if (strpos($_SERVER["SCRIPT_NAME"], "index.php")) {
    if (!isset($_SESSION[LOGIN]) || strcmp($_SESSION[LOGIN], sha1($_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"])) !== 0) {
        header(FORWARD_LOGINFORM);
    }
}

if (strpos($_SERVER["SCRIPT_NAME"], "login.php")) {
    if (isset($_SESSION[LOGIN]) && strcmp($_SESSION[LOGIN], sha1($_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"])) === 0) {
        header(FORWARD_INDEX);
    }
}