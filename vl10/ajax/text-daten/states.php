<?php

$capitals = [
    "Please select a state",
    "Eisenstadt",
    "Klagenfurt",
    "Sankt Pölten",
    "Salzburg",
    "Graz",
    "Innsbruck",
    "Linz",
    "Bregenz",
    "Vienna"
];

header("Content-Type: text/plain");
if (isset($_GET["index"])) {
    http_response_code(200);
    echo $capitals[$_GET["index"]];
}
else {
    http_response_code(400);
}
