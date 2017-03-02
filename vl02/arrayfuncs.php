<?php
$arr1 = array(2, "Hallo", 4.3);
$arr2 = array("Test", 7, array(3, 5, "Hi"));
echo count($arr1) . "<br>"; // 3
echo count($arr2) . "<br>"; // 3
echo count($arr2, 1) . "<br><br>"; // 6

$text = "Hello little world!";
$pieces = explode(" ", $text); //
print_r($pieces);

$parts = array("name", "alter", "geschlecht");
$string = implode(",", $parts);
echo "<p>$string</p>";

$date = "03/10/2015";
$values = preg_split("#[/.-]#", $date);
print_r($values);