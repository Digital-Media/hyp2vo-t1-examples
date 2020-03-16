<?php

require "LocatableTrait.php";

/**
 * Eine Person, die über Koordinaten ortbar sein möchte.
 */
class Person
{
    use LocatableTrait;

    // ...
}

$pers = new Person();
$pers->setPosition([48.368201, 14.514065]);
echo "<p>Latitude: " . $pers->getLatitude() . "°</p>";
echo "<p>Longitude: " . $pers->getLongitude() . "°</p>";
