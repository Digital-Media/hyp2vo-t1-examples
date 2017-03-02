<?php
// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate colors
$yellow = imagecolorallocate($image, 255, 255, 0);
$cyan = imagecolorallocate($image, 0, 255, 255);

// Arcs
imagearc($image, 70, 50, 100, 60, 270, 0, $yellow);
imagefilledarc($image, 150, 150, 300, 100, 180, 270, $cyan, IMG_ARC_PIE);
imagefilledarc($image, 220, 220, 100, 100, 0, 360, $yellow, IMG_ARC_PIE);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);