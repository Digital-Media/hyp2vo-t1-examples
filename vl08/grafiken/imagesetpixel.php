<?php
// Create image
$width = $height = 10;
$image = imagecreatetruecolor($width, $height);

// Allocate some colors
$gray = imagecolorallocate($image, 192, 192, 192);
$red = imagecolorallocate($image, 255, 0, 0);
$yellow = imagecolorallocate($image, 255, 255, 0);

// Set the pixels
imagesetpixel($image, 0, 0, $gray);
imagesetpixel($image, 5, 5, $red);
imagesetpixel($image, 9, 9, $yellow);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
