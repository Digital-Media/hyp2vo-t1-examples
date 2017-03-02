<?php
$name = "John Doe";
$hdText = <<<EOT
Dies ist ein mehrzeiliger Text
von $name,
der genau so
durch die Zeilenumbrüche
im String
gespeichert wird.
EOT;

$ndText = <<<'EOT'
Dies ist ein mehrzeiliger Text
von $name,
der genau so
durch die Zeilenumbrüche
im String
gespeichert wird.
EOT;

// Anmerkung: Hier werden nur Strings gespeichert, aber nicht ausgegeben (daher ist die Seite weiß).