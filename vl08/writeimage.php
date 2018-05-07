<?php
// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Display image
imagepng($image, "emptyimage.png");
imagedestroy($image);
