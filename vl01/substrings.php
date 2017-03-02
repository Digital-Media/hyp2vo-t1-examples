<?php
$str = "Hallo Welt";
echo substr($str, 2, 3) . "<br>"; // llo
echo substr($str, -2) . "<br>"; // lt
echo substr($str, -3, 2) . "<br>"; // el
echo substr($str, 2, -3); // llo W