<?php

$jsonString = file_get_contents("addressbook.json");

// Ausgabe als Objekt
$jsonData = json_decode($jsonString);

// Ausgabe als assoziatives Array
//$jsonData = json_decode($jsonString, true);

var_dump($jsonData);

// Zugriff auf Objekteigenschaften
echo $jsonData->lastName; // Doe
echo $jsonData->address->street; // 21 Doe St.
echo $jsonData->phoneNumbers[1]->number; // 800 999 666-333

// Zugriff auf Arraywerte
/*echo $jsonData["lastName"]; // Doe
echo $jsonData["address"]["street"]; // 21 Doe St.
echo $jsonData["phoneNumbers"][1]["number"]; // 800 999 666-333*/
