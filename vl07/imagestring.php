<?php
// Create image
$width = $height = 300;
$image = imagecreatetruecolor($width, $height);

// Allocate a color
$white = imagecolorallocate($image, 255, 255, 255);

imagechar($image, 1, 10, 10, "A", $white);
imagecharup($image, 2, 20, 20, "B", $white);
imagestring($image, 3, 50, 50, "Hallo!", $white);
imagestringup($image, 5, 200, 200, "HM2", $white);

// Display image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);