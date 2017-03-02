<?php
define("USERNAME", "John Doe");
echo USERNAME; // John Doe
echo Username; // Username (mit Warnung/Notice)

if (defined("USERNAME")) {
    echo "<p>Welcome " . USERNAME . "!</p>";
}

# Magische Konstanten

echo __LINE__ . "<br>"; // Aktuelle Zeilennummer im Skript

# Core Konstanten

echo PHP_VERSION . "<br>"; // PHP-Version
echo PHP_OS . "<br>"; // Betriebssystem auf dem PHP dzt. läuft
echo PHP_INT_MAX . "<br>"; // Maximale Integer-Größe
echo PHP_INT_SIZE . "<br>"; // Wie viel Byte hat ein Integer?

# Standard Konstanten

echo M_PI; // Pi