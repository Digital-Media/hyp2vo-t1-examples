<?php
if (preg_match("/a/", "Hallo Welt!")) {
    echo "<p>1. okay!<p>";
}

if (preg_match("/[abc ]/", "Hallo Welt!")) {
    echo "<p>2. okay!<p>";
}

if (preg_match("/[[:alnum:]]/", "Hallo 2017!")) {
    echo "<p>3. okay!<p>";
}

if (preg_match("/H[^aeiou]llo/", "Hallo Welt!")) {
    echo "<p>4. okay!<p>"; // wird nicht betreten
}

if (preg_match("/a(bc)* /", "bc")) {
    echo "<p>5. okay!<p>"; // wird nicht betreten
}

if (preg_match("/([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})/", "07.03.2017", $matches)) {
    echo $matches[0] . "<br>"; // 07.03.2017
    echo $matches[1] . "<br>"; // 07
    echo $matches[2] . "<br>"; // 07
    echo $matches[3]; // 2017
}
