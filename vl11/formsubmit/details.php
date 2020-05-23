<?php

if (isset($_POST)) {
    // Set $_POST to the last position and get the array key
    end($_POST);
    $lastKey = key($_POST);

    foreach ($_POST as $key => $value) {
        $output = $key . ": " . $value;
        // If not on the last position, add a line break
        if ($key !== $lastKey) {
            $output .= PHP_EOL;
        }
        echo $output;
    }
}
