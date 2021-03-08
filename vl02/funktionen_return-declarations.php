<?php
// Strikte Typen erzwingen
//declare(strict_types = 1);

// Error Handling, um Fehlermeldungen zu sehen
const DEBUG = true;

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set("html_errors", "1");
    ini_set("display_errors", "1");
}

// Rückgabewertsdeklaration

function getSum($a, $b): int
{
    return $a + $b;
}

echo "<p>Summe: " . getSum(3, 4) . "</p>"; // funktioniert
echo "<p>Summe: " . getSum(3.0, 4.0) . "</p>"; // funktioniert, wenn declare(strict_types = 1) nicht gesetzt
echo "<p>Summe: " . getSum(3.0, 2.5) . "</p>"; // funktioniert, wenn declare(strict_types = 1) nicht gesetzt,
// erzeugt aber als Ergebnis 5, weil auf int abgeschnitten wird

// Nullable Rückgabewertsdeklaration

function getSumOrNull($a, $b): ?int
{
    return ($a + $b) > 0 ? $a + $b : null;
}

echo "<p>Summe: " . getSumOrNull(5, 1) . "</p>"; // funktioniert und liefert int
echo "<p>Summe: " . getSumOrNull(0, 0) . "</p>"; // funktioniert und liefert null (nicht 0)

// Void Returns

function getNothing(): void
{
    echo "<p>Hier wird nichts zurückgegeben.</p>";
    return; // Optional, hier besser gleich weglassen
}

getNothing();
