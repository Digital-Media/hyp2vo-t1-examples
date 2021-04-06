<?php

$fp = fopen("entchen.txt", "r");
$str1 = fgets($fp);
$str2 = fgets($fp, 3);
$str3 = fgets($fp, 1024);
fclose($fp);

echo "<p>$str1</p>";
echo "<p>$str2</p>";
echo "<p>$str3</p>";
