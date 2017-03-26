<?php
try {
    throw new Exception("Allgemeiner Fehler!");
    echo "Wird nicht mehr anzegeigt.";
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}

echo "Weiter nach Fehlerbehandlung";
