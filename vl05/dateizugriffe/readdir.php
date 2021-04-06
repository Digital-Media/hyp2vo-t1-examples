<?php

$handle = opendir(".");
while ($file = readdir($handle)) {
    echo "<p>$file</p>" . PHP_EOL;
}
closedir($handle);
