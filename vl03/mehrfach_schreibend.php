<?php
$fp = fopen("datei.txt", "a");
$lock = flock($fp, LOCK_EX); // Lock anfordern
if ($lock) { // Wenn Lock erhalten
    $bytes = fwrite($fp, "Hallo Welt!\n");
    if ($bytes > 0) {
        echo "<p>Datei geschrieben!</p>";
    }
    flock($fp, LOCK_UN); // Lock freigeben
}
else { // Wenn Lock nicht erhalten
    echo "<p>Kann Datei nicht öffnen!</p>";
}
fclose($fp);