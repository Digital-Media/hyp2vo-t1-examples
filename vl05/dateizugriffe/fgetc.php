<?php

$fp = fopen("entchen.txt", "r");
$char = fgetc($fp);
fclose($fp);

echo "<p>$char</p>"; // A
