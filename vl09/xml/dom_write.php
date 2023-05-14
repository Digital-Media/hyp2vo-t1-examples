<?php

require "Hypermedia2/Vl09/XMLDomWriter.php";

use Hypermedia2\Vl09\XMLDomWriter;

$shows = [
    [
        "name" => "The Mandalorian",
        "service" => "Disney+",
        "resolution" => "2160p",
        "duration" => "40"
    ],
    [
        "name" => "Rick and Morty",
        "service" => "Netflix",
        "resolution" => "1080p",
        "duration" => "20"
    ]
];

$xmlWriter = new XMLDomWriter($shows);
try {
    $xmlWriter->generateXML("dom_shows.xml");
} catch (DOMException $e) {
    echo "An error occurred: " . $e->getMessage();
}
