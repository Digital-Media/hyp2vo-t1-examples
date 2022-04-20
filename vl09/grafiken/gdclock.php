<?php

/**
 * Code adapted from https://www.codelibary.com/snippet/655/gd-clock
 */

// Define measurements
$max_length = 150;
$marker = 5;
$origin_x = $origin_y = $max_length / 2;
$radius = $max_length / 2 - 2;
$hour_segment = $radius * 0.50;
$minute_segment = $radius * 0.80;

// Create image
$image = imagecreatetruecolor($max_length, $max_length);

// Allocate colors
$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);
$white = imagecolorallocate($image, 254, 255, 255);

// Get current time
date_default_timezone_set("Europe/Vienna");
$lt = localtime();

// Calculate hand angles
$hour_angle = deg2rad(($lt[2] + ($lt[1] / 60) - 3) * 30);
$minute_angle = deg2rad(($lt[1] + ($lt[0] / 60) - 15) * 6);

// White background
imagefilledrectangle($image, 0, 0, $max_length, $max_length, $white);

// Outer clock circle
imagearc(
    $image,
    $origin_x,
    $origin_y,
    $max_length - 2,
    $max_length - 2,
    0,
    360,
    $blue
);

// Hour markers
for ($i = 0; $i < 360; $i = $i + 30) {
    $degrees = deg2rad($i);
    imageline(
        $image,
        $origin_x + (($radius - $marker) * cos($degrees)),
        $origin_y + (($radius - $marker) * sin($degrees)),
        $origin_x + ($radius * cos($degrees)),
        $origin_y + ($radius * sin($degrees)),
        $red
    );
}

// Hour hand
imageline(
    $image,
    $origin_x,
    $origin_y,
    $origin_x + ($hour_segment * cos($hour_angle)),
    $origin_y + ($hour_segment * sin($hour_angle)),
    $black
);

// Minute hand
imageline(
    $image,
    $origin_x,
    $origin_y,
    $origin_x + ($minute_segment * cos($minute_angle)),
    $origin_y + ($minute_segment * sin($minute_angle)),
    $black
);

// Center dot
imagearc($image, $origin_x, $origin_y, 6, 6, 0, 360, $red);
imagefill($image, $origin_x + 1, $origin_y + 1, $red);

// Draw image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
