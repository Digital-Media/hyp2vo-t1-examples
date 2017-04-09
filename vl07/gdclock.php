<?php
/**
 * Code adapted from https://www.codewalkers.com/c/a/Miscellaneous/An-Intro-to-Using-the-GD-Image-Library-with-PHP/
 */

// Get the current time
$time = strftime("%I:%M:%S", time());
$timearray = explode(':', $time);

$hour = (((int)$timearray[0]) * 60) + (int)$timearray[1];
$minute = (int)$timearray[1];
$second = (int)$timearray[2];

if ($hour != 0) {
    $hourdegree = ((360 / (720 / $hour)) - 90) % 360;
    if ($hourdegree < 0) {
        $hourdegree = 360 + $hourdegree;
    }
} else {
    $hourdegree = 270;
}

if ($minute != 0) {
    $minutedegree = ((360 / (60 / $minute)) - 90) % 360;
    if ($minutedegree < 0) {
        $minutedegree = 360 + $minutedegree;
    }
} else {
    $minutedegree = 270;
}

if ($second != 0) {
    $seconddegree = ((360 / (60 / $second)) - 90) % 360;
    if ($seconddegree < 0) {
        $seconddegree = 360 + $seconddegree;
    }
} else {
    $seconddegree = 270;
}

// Draw clock and watch hands
$image = imagecreate(100, 100);
$maroon = imagecolorallocate($image, 123, 9, 60);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

imagefilledrectangle($image, 0, 0, 99, 99, $white);
imagefilledellipse($image, 49, 49, 100, 100, $black);
imagefilledellipse($image, 49, 49, 95, 95, $maroon);
imagefilledellipse($image, 49, 49, 75, 75, $white);
imagefilledellipse($image, 49, 49, 5, 5, $maroon);
imagefilledarc($image, 49, 49, 50, 50, $hourdegree - 4, $hourdegree + 4, $maroon, IMG_ARC_PIE);
imagefilledarc($image, 49, 49, 65, 65, $minutedegree - 3, $minutedegree + 3, $maroon, IMG_ARC_PIE);
imagefilledarc($image, 49, 49, 70, 70, $seconddegree - 2, $seconddegree + 2, $black, IMG_ARC_PIE);

imagecolortransparent($image, $white);

// Add the text
imagettftext($image, 8, 0, 44, 11, $white, "arial.ttf", "12");
imagettftext($image, 8, 0, 89, 53, $white, "arial.ttf", "3");
imagettftext($image, 8, 0, 47, 96, $white, "arial.ttf", "6");
imagettftext($image, 8, 0, 5, 53, $white, "arial.ttf", "9");

// Output the image
header("Content-type: image/png");
imagepng($image);
//imagePNG($image, "clock.png");
imagedestroy($image);
