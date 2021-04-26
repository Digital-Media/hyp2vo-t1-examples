<?php

// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate colors
$yellow = imagecolorallocate($image, 255, 255, 0);
$cyan = imagecolorallocate($image, 0, 255, 255);

// Polygons
$hexagon = [100, 50, 150, 50, 200, 100, 150, 150, 100, 150, 50, 100];
$triangle = [100, 250, 175, 100, 250, 250];
imagepolygon($image, $hexagon, $yellow);
imagefilledpolygon($image, $triangle, $cyan);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
