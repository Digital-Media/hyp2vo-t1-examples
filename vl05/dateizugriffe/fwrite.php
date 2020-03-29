<?php
$string = "Hello World!";
$fp = fopen("world.txt", "w");
$bytes = fwrite($fp, $string);
if ($bytes > 0) {
    echo "Datei geschrieben!";
}
fclose($fp);
