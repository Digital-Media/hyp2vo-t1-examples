<?php

use Hypermedia2\Vl11\SearchData;

require_once("Hypermedia 2/Vl11/SearchData.php");

$data = new SearchData();
$titles = $data->getTitles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>AJAX &ndash; Search Suggest</title>
    <meta charset=utf-8">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<h1>Search Result</h1>

<div>
    <?php
    if (in_array($_GET["search"], $titles)) {
        echo("Exact search String found: " . $_GET["search"]);
    } else {
        echo("Exact search String not found: " . $_GET["search"]);
    }
    ?>
</div>
</body>
</html>
