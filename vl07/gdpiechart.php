<?php
/**
 * Code adapted from https://en.wikipedia.org/wiki/GD_Graphics_Library
 */

// Create an image
$width = $height = 1000;
$image = imagecreatetruecolor($width, $height);

// Allocate some colors
$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$gray = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$navy = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkred = imagecolorallocate($image, 0x90, 0x00, 0x00);

// Set background to white
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Make the 3D effect
for ($i = 600; $i > 500; $i--) {
    imagefilledarc($image, 500, $i, 1000, 500, 0, 45, $darknavy, IMG_ARC_PIE);
    imagefilledarc($image, 500, $i, 1000, 500, 45, 75, $darkgray, IMG_ARC_PIE);
    imagefilledarc($image, 500, $i, 1000, 500, 75, 360, $darkred, IMG_ARC_PIE);
}

imagefilledarc($image, 500, 500, 1000, 500, 0, 45, $navy, IMG_ARC_PIE);
imagefilledarc($image, 500, 500, 1000, 500, 45, 75, $gray, IMG_ARC_PIE);
imagefilledarc($image, 500, 500, 1000, 500, 75, 360, $red, IMG_ARC_PIE);

// Flush the image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);