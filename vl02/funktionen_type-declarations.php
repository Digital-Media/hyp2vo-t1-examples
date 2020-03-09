<?php
// Strikte Typen erzwingen
//declare(strict_types = 1);

// Error Handling, um Fehlermeldungen zu sehen
define('DEBUG', true);

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('html_errors', '1');
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
}

// Typdeklaration

function isInt(int $number)
{
    echo "<p>Eine Zahl: $number</p>";
}

isInt(3); // funktioniert
isInt("3"); // funktioniert, wenn declare(strict_types = 1) nicht gesetzt
//isInt("hallo"); // funktioniert nie

// Mit nullable Type

function isIntOrNull(?int $number)
{
    echo "<p>Eine Zahl: $number</p>";
}

isIntOrNull(5); // funktioniert
isIntOrNull(null); // funktioniert auch
