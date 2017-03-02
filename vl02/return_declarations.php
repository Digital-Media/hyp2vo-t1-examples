<?php
//declare(strict_types = 1);

# Rückgabewertsdeklaration

function getSum($a, $b) : int {
    return $a + $b;
}

echo "<p>Summe: " . getSum(3, 4) . "</p>"; // funktioniert
echo "<p>Summe: " . getSum(3.0, 4.0) . "</p>"; // funktioniert, wenn declare(strict_types=1) nicht gesetzt
echo "<p>Summe: " . getSum(3.0, 2.5) . "</p>"; // funktioniert, wenn declare(strict_types=1) nicht gesetzt,
                                               // erzeugt aber als Ergebnis 5, weil auf int abgeschnitten wird
