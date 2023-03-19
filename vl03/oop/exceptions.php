<?php

try {
    throw new Exception("Allgemeiner Fehler!");
    echo "Wird nicht mehr angezeigt.";
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}

echo "Weiter nach Fehlerbehandlung";
