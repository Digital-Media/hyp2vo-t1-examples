<?php

require "Hypermedia2/Vl09/XMLOOParser.php";

use Hypermedia2\Vl09\XMLOOParser;

$xmlParser = new XMLOOParser();
$xmlParser->parse("rezept.xml");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>DOM-Parser</title>
    <meta charset="utf-8">
</head>
<body>
<h1><?= $xmlParser->getDish() ?></h1>

<p>Quelle: <a href="<?= $xmlParser->getSource() ?>"><?= $xmlParser->getSource() ?></a></p>

<h2>Zutaten</h2>

<ul>
    <?php
    $ingredients = $xmlParser->getIngredients();
    foreach ($ingredients as $ingredient) {
        echo "<li>" . $ingredient["menge"] . " " . $ingredient["einheit"] . " " . $ingredient["ingredienz"] . "</li>";
    }
    ?>
</ul>

<h2>Zubereitung</h2>

<ol>
    <?php
    $steps = $xmlParser->getSteps();
    foreach ($steps as $step) {
        echo "<li>$step</li>";
    }
    ?>
</ol>
</body>
</html>
