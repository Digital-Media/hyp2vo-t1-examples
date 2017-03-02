<?php
// if-else-Bedingung
$name = "";
if ($name !== "") {
    $username = $name;
} else {
    $username = "John Doe";
}

$n = 3;
// if-else-Kaskade
if ($n === 1) {
    // Code 1
} else {
    if ($n === 2) {
        // Code 2
    } else {
        // Restlicher Code
    }
}

// if-elseif-else-Kaskade
if ($n === 1) {
    // Code 1
} elseif ($n === 2) {
    // Code 2
} else {
    // Restlicher Code
}

// Switch-Anweisung statt Kaskade
switch ($n) {
    case 1:
        // Code 1
        break;
    case 2:
        // Code 2
        break;
    default:
        // Restlicher Code
        break;
}
