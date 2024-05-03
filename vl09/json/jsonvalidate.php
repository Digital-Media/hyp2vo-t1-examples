<?php

$jsonString = file_get_contents("addressbook.json");

$jsonIsValid = json_validate($jsonString);

if ($jsonIsValid) {
    echo "The JSON structure is valid.";
} else {
    echo "The JSON structure is not valid.";
}
