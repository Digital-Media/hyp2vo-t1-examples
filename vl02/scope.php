<?php
# Lokale Variable

function foolokal() {
    $x = "Lokal";
}

$x = "Global";
foolokal();
echo "<p>$x</p>"; // Global

# Globale Variable

function fooglobal() {
    global $x;
    $x = "Jetzt global";
}

$x = "Global";
fooglobal();
echo "<p>$x</p>"; // Jetzt global

# Statische Variable

function counter() {
    static $count = 0;
    return $count++;
}

for ($i = 0; $i < 5; $i++) {
    echo counter();
}