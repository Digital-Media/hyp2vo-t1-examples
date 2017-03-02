<?php

class XMLWriterWrite {
    private $writer;

    public function __construct() {
        $this->writer = new XMLWriter();

        $this->shows = [
            ["name" => "Die Simpsons",
                "kanal" => "FOX",
                "beginn" => "20:00",
                "dauer" => "20"],
            ["name" => "Game of Thrones",
                "kanal" => "HBO",
                "beginn" => "21:00",
                "dauer" => "60"]
        ];
    }

    public function generateXML($file) {
        $this->writer->openUri($file);
        $this->writer->setIndent(true);

        $this->writer->startDocument("1.0", "UTF-8");
        $this->writer->startElement("shows");

        foreach ($this->shows as $show) {
            $this->writer->startElement("show");
            foreach ($show as $tag => $data) {
                $this->writer->writeElement($tag, $data);
            }
            $this->writer->endElement();
        }
        $this->writer->endElement();

        $this->writer->endDocument();

        $this->writer->flush();
    }
}

$xmlwrite = new XMLWriterWrite();
$xmlwrite->generateXML("xmlwriter_shows.xml");