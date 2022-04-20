<?php

// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate a color
$white = imagecolorallocate($image, 255, 255, 255);

imagettftext($image, 50, 45, 60, 260, $white, "./comic.ttf", "Helvetica");

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
