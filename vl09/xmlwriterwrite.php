<?php
require "Hypermedia2/Vl09/XMLWriterWriter.php";

use Hypermedia2\Vl09\XMLWriterWriter;

$xmlWriter = new XMLWriterWriter();
$xmlWriter->generateXML("xmlwriter_shows.xml");
