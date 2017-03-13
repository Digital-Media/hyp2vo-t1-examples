<?php
$array = ["HM2", "Hagenberg", "MTD16"];
$fp = fopen("studium.csv", "w");
$bytes = fputcsv($fp, $array, ";");
if ($bytes > 0) {
    echo "CSV-Datei geschrieben!";
}
fclose($fp);
