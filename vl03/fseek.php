<?php
$fp = fopen("entchen.txt", "r");
echo ftell($fp); // 0
$str1 = fgets($fp);
echo ftell($fp); // 20
fseek($fp, 29, SEEK_CUR);
echo ftell($fp); // 49
rewind($fp);
echo ftell($fp); // 0
fclose($fp);