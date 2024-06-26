<?php

$d = new DateTime("2024-04-29T10:30:00+02:00");

$twoWeeks = new DateInterval("P2W");
$oneDay5Hours3Mins10Secs = new DateInterval("P1DT5H3M10S");
$seventeenHours = new DateInterval("PT17H");

echo "<p>Original Date: " . $d->format("r") . "</p>";
echo "<p>Plus 2 weeks: " . $d->add($twoWeeks)->format("r") . "</p>";
echo "<p>Plus 1 day 5 hours 3 minutes and 10 seconds: " . $d->add($oneDay5Hours3Mins10Secs)->format("r") . "</p>";
echo "<p>Minus 17 hours: " . $d->sub($seventeenHours)->format("r") . "</p>";
