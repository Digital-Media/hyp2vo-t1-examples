<?php

header("Content-Type: text/plain");

if (!empty($_POST)) {
    $lastKey = array_key_last($_POST);
    $output = "";

    foreach ($_POST as $key => $value) {
        $output .= $key . ": " . $value . ($key !== $lastKey ? PHP_EOL : "");
    }

    http_response_code(200);
    echo $output;
} else {
    http_response_code(400);
}