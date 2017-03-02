<?php
$fp = fopen("person.csv", "r");
$array = fgetcsv($fp);
fclose($fp);

print_r($array); // Array ( [0] => John [1] => Doe [2] => 34 )