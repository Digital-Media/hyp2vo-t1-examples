<?php

/**
 * Code originally adapted from http://www.akchauhan.com/dynamic-progress-bar-or-status-bar-using-gd-library/
 */

// Set width and height of progress bar in px
$width = 500;
$height = 50;

// Current percentage (50 if not set)
$current = isset($_GET["c"]) ? $_GET["c"] : 50;
// Start percentage (0 if not set)
$start = isset($_GET["s"]) ? $_GET["s"] : 0;
// End percentage (100 if not set)
$end = isset($_GET["e"]) ? $_GET["e"] : 100;
// Print text (true if not set)
$p = isset($_GET["p"]) ? $_GET["p"] : true;

// Calculate current position in px
$pos = floor($current / ($end - $start) * $width);

// Create an image and set colors
$image = imagecreate($width, $height); // width , height px
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$green = imagecolorallocate($image, 0, 204, 51);

// Set the border thickness
imagesetthickness($image, $height * 0.1);

// Fill the rectangle with the amount needed and draw the border
imagefilledrectangle($image, 0, 0, $pos, $height, $green);
imagerectangle($image, 0, 0, $width, $height, $black);

// Display text text centered if enabled
if ($p) {
    $text = floor($pos / $width * 100) . " %";
    $font = __DIR__ . "/arial.ttf";
    $font_size = $height * 0.3;
    $black = imagecolorallocate($image, 0, 0, 0);
    $text_size = imagettfbbox($font_size, 0, $font, $text);
    $text_length = $text_size[2] - $text_size[0];
    $textX = $width / 2 - $text_length / 2;
    $textY = $height / 2 + $font_size / 2;
    imagettftext($image, $font_size, 0, $textX, $textY, $black, $font, $text);
}

// Output the image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
