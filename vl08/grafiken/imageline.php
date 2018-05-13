<?php
// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate a color
$yellow = imagecolorallocate($image, 255, 255, 0);

// The line must be drawn here! This far, no further!
imageline($image, 50, 50, 220, 190, $yellow);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
