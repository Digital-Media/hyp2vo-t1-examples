<?php

require "Hypermedia2/Vl09/Person.php";

use Hypermedia2\Vl09\Person;

$array = ["Good", "Bad", "Ugly"];

$assocArray = ["key" => "value", "otherkey" => "othervalue"];

$simpleNumber = 42;

$jsonObject = json_encode(new Person("John Doe", 34, "Doeland"), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$jsonArray = json_encode($array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$jsonAssocArray = json_encode($assocArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$jsonInteger = json_encode($simpleNumber, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

file_put_contents("object.json", $jsonObject);
file_put_contents("array.json", $jsonArray);
file_put_contents("assocarray.json", $jsonAssocArray);
file_put_contents("integer.json", $jsonInteger);

echo json_last_error_msg();
