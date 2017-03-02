<?php

class XMLOoSimpleParse {
    public function parse($file) {
        $xml = simplexml_load_file($file);

        //var_dump($xml);

        $attributes = $xml->attributes();
        echo $xml->getName() . ": " . $attributes["quelle"] . "<br>";

        echo $xml->gericht->getName() . ": " . $xml->gericht . "<br>";

        echo $xml->zutaten->getName() . "<br>";

        foreach ($xml->zutaten->zutat as $zutat) {
            echo $zutat->getName() . "<br>";
            echo $zutat->ingredienz->getName() . ": " . $zutat->ingredienz . "<br>";
            echo $zutat->menge->getName() . ": " . $zutat->menge . "<br>";
            echo $zutat->einheit->getName() . ": " . $zutat->einheit . "<br>";
        }

        echo $xml->zubereitung->getName() . "<br>";

        foreach ($xml->zubereitung->schritt as $schritt) {
            echo $schritt->getName() . ": " . $schritt . "<br>";
        }

        /*$xml = simplexml_load_file($file, "SimpleXMLIterator");
        $iterator = new RecursiveIteratorIterator($xml, RecursiveIteratorIterator::SELF_FIRST);

        foreach($iterator as $name => $element) {
            for ($i = 0; $i < $iterator->getDepth(); $i++) {
                echo "&nbsp;&nbsp;";
            }
            if ($element !== "") {
                echo $name . ": " . $element . "<br>";
            }
            else {
                echo $name . "<br>";
            }
        }*/
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>SimpleXML-Parser</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Output:</h1>

<p>
    <?php
    $xmlparse = new XMLOoSimpleParse();
    $xmlparse->parse("rezept.xml");
    ?>
</p>
</body>
</html>
