<?php
require "Hypermedia2/Vl09/XMLDomWriter.php";

use Hypermedia2\Vl09\XMLDomWriter;

$xmlWriter = new XMLDomWriter();
$xmlWriter->generateXML("dom_shows.xml");
