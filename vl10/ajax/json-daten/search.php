<?php

require_once("Hypermedia 2/Vl10/SearchData.php");

use Hypermedia2\Vl10\SearchData;

$data = new SearchData();

header("Content-Type: application/json");
if (isset($_GET["search"])) {
    http_response_code(200);
    echo $data->search($_GET["search"]);
}
else {
    http_response_code(400);
}
