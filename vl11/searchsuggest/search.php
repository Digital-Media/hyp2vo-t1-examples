<?php

require_once("Hypermedia 2/Vl11/SearchData.php");

use Hypermedia2\Vl11\SearchData;

$data = new SearchData();

if (isset($_GET["search"])) {
    echo $data->search($_GET["search"]);
}
