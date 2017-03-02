<?php
$staedte = ["Bitte ein Bundesland auswählen",
            "Eisenstadt",
            "Klagenfurt",
            "Sankt Pölten",
            "Linz",
            "Salzburg",
            "Graz",
            "Innsbruck",
            "Bregenz",
            "Wien"];

echo $staedte[$_GET["index"]];