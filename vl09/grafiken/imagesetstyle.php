<?php

// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate colors
$yellow = imagecolorallocate($image, 255, 255, 0);
$blue = imagecolorallocate($image, 0, 0, 255);

// Set thickness
imagesetthickness($image, 5);

// Rectangle
imagerectangle($image, 10, 10, 110, 110, $yellow);

// Set style
$style = [$yellow, $yellow, $yellow, $blue, $blue, $blue];
imagesetstyle($image, $style);

// Line
imageline($image, 160, 160, 290, 290, IMG_COLOR_STYLED);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
