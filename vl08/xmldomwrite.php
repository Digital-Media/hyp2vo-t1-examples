<?php

class XMLDomWrite
{
    private $dom;

    public function __construct()
    {
        $this->dom = new DOMDocument("1.0", "UTF-8");
        $this->dom->formatOutput = true;
        $this->shows = [
            [
                "name" => "Die Simpsons",
                "kanal" => "FOX",
                "beginn" => "20:00",
                "dauer" => "20"
            ],
            [
                "name" => "Game of Thrones",
                "kanal" => "HBO",
                "beginn" => "21:00",
                "dauer" => "60"
            ]
        ];
    }

    public function generateXML($file)
    {
        $shows = $this->dom->appendChild($this->dom->createElement("shows"));

        foreach ($this->shows as $show) {
            $showElem = $shows->appendChild($this->dom->createElement("show"));
            foreach ($show as $tag => $data) {
                $showElem->appendChild($this->dom->createElement($tag, htmlentities($data)));
            }
        }

        $this->dom->save($file);
    }
}

$xmlWrite = new XMLDomWrite();
$xmlWrite->generateXML("dom_shows.xml");
