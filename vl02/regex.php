<?php
if (preg_match("/a/", "Hallo Welt!")) {
    echo "<p>1. okay!<p>";
}

if (preg_match("/[abc ]/", "Hallo Welt!")) {
    echo "<p>2. okay!<p>";
}

if (preg_match("/[[:alnum:]]/", "Hallo 2018!")) {
    echo "<p>3. okay!<p>";
}

if (preg_match("/H[^aeiou]llo/", "Hallo Welt!")) {
    echo "<p>4. okay!<p>"; // wird nicht betreten
}

if (preg_match("/a(bc)* /", "bc")) {
    echo "<p>5. okay!<p>"; // wird nicht betreten
}

if (preg_match("/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})/", "13.03.2018", $matches)) {
    echo $matches[0] . "<br>"; // 13.03.2018
    echo $matches[1] . "<br>"; // 13
    echo $matches[2] . "<br>"; // 03
    echo $matches[3]; // 2018
}
