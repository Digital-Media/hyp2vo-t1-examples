<?php

require "Hypermedia2/Vl09/XMLWriterWriter.php";

use Hypermedia2\Vl09\XMLWriterWriter;

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

$xmlWriter = new XMLWriterWriter($shows);
$xmlWriter->generateXML("xmlwriter_shows.xml");
