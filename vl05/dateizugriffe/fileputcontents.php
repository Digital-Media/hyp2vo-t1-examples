<?php

$string = "Hello World!";
$bytes = file_put_contents("world.txt", $string);
if ($bytes > 0) {
    echo "Datei geschrieben!";
}
