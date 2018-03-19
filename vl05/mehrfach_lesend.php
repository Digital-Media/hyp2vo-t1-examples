<?php
$fp = fopen("entchen.txt", "r");
$lock = flock($fp, LOCK_SH); // Lock anfordern
$contents = "";
if ($lock) { // Wenn Lock erhalten
    while (!feof($fp)) {
        $contents .= fgets($fp);
    }
    flock($fp, LOCK_UN); // Lock freigeben
} else { // Wenn Lock nicht erhalten
    echo "<p>Kann Datei nicht öffnen!</p>";
}
fclose($fp);

echo "<p>$contents</p>"; // Alle meine Entchen ...
