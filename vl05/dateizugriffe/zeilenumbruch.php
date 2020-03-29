<?php
$line1 = "Das ist Zeile 1.";
$line2 = "Und das Zeile 2.";

$fp = fopen("eol.txt", "w");
$bytes = fwrite($fp, $line1 . PHP_EOL);
$bytes += fwrite($fp, $line2);
if ($bytes > 0) {
    echo "Zeilen geschrieben!";
}
fclose($fp);
