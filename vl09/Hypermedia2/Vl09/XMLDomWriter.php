<?php

namespace Hypermedia2\Vl09;

use DOMDocument;

/**
 * Creates a new XML file based on the data created in the constructor using DOM.
 *
 * @package Hypermedia2\Vl09
 */
class XMLDomWriter
{
    // Writer related properties

    /**
     * The DOM instance.
     *
     * @var DOMDocument
     */
    private DOMDocument $dom;

    // Document data properties

    /**
     * The data used for creating the XML file.
     *
     * @var array
     */
    private array $shows;

    /**
     * Initializes the DOM document and the data used for XML creation.
     */
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

    /**
     * Creates a new XML file based on the $shows property and writes it to a file.
     *
     * @param string $file The XML file name.
     */
    public function generateXML(string $file): void
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
