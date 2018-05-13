<?php
// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate colors
$red = imagecolorallocate($image, 255, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$blue = imagecolorallocate($image, 0, 0, 255);

// Mark blue as transparent
imagecolortransparent($image, $blue);

// Rectangle
imagefilledrectangle($image, 50, 50, 250, 250, $red);

// Set thickness and style
imagesetthickness($image, 50);
$style = array($white, $white, $white, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
imagesetstyle($image, $style);

// Draw line
imageline($image, 0, 150, 300, 150, IMG_COLOR_STYLED);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
