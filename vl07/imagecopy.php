<?php
// Create image
$width = $height = 300;
$image1 = imagecreatetruecolor($width, $height);
$image2 = imagecreatetruecolor(100, 100);

// Allocate a color
$yellow = imagecolorallocate($image1, 255, 255, 0);

// Rectangles
imagerectangle($image1, 10, 10, 110, 110, $yellow);
imagefilledrectangle($image1, 70, 120, 280, 250, $yellow);

imagecopy($image2, $image1, 0, 0, 50, 50, 100, 100);

// Display image
header("Content-type: image/png");
imagepng($image2);
imagedestroy($image1);
imagedestroy($image2);