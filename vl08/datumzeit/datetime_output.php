<?php

// Zeitzone setzen, denn diese ist im Vagrant-Image in php.ini nicht gesetzt (sonst UTC)
date_default_timezone_set("Europe/Vienna");

/* Aktuelle Uhrzeit (UTC) */
$d = new DateTime();
echo "<p>It's now " . $d->format("r") . "</p>";
echo "<p>It's now " . $d->format("d.m.Y, G:i:s e") . "</p>";
