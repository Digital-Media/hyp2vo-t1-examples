<?php

// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate a color
$yellow = imagecolorallocate($image, 255, 255, 0);
$black = imagecolorallocate($image, 0, 0, 0);

// Rectangles
imagerectangle($image, 10, 10, 110, 110, $yellow);
imagefilledrectangle($image, 70, 120, 280, 250, $yellow);

$image = imagerotate($image, 45, $black);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
