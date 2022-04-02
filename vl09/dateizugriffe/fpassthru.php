<?php

$fp = fopen("entchen.txt", "r");
fpassthru($fp); // Alle meine Entchen\nschwimmen auf dem See,\nschwimmen...
fclose($fp);
