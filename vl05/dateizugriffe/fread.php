<?php
$filename = "php.gif";
$fp = fopen($filename, "rb");
$contents = fread($fp, filesize($filename));
fclose($fp);
echo $contents;
