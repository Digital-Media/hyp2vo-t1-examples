<?php
// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
