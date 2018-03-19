<?php
$fp = fopen("entchen.txt", "r");
while (!feof($fp)) {
    $str = fgets($fp);
    echo $str;
}
fclose($fp);
