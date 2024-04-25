<?php

$d1 = new DateTime("2024-04-29T10:30:00+02:00");
$d2 = new DateTimeImmutable("2024-04-29T10:30:00+02:00");
$fortyFiveMinutes = new DateInterval("PT45M");

$d1->add($fortyFiveMinutes);
$d3 = $d2->add($fortyFiveMinutes);

echo "<p>DateTime object after add(): " . $d1->format("r") . "</p>";
echo "<p>DateTimeImmutable object after add(): " . $d2->format("r") . "</p>";
echo "<p>Returned object of add(): " . $d3->format("r") . "</p>";
