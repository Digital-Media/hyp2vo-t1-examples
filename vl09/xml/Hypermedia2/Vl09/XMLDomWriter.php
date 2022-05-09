<?php

namespace Hypermedia2\Vl09;

use DOMDocument;
use DOMException;

/**
 * Creates a new XML file based on the data passed to the constructor using DOM.
 * @package Hypermedia2\Vl09
 */
class XMLDomWriter
{
    // Writer related properties

    /**
     * The DOM instance.
     * @var DOMDocument
     */
    private DOMDocument $dom;

    // Document data properties

    /**
     * The data used for creating the XML file.
     * @var array
     */
    private array $shows;

    /**
     * Initializes the DOM document with the data used for XML creation.
     * @param array $shows The data used for creating the XML file.
     */
    public function __construct(array $shows)
    {
        $this->dom = new DOMDocument("1.0", "UTF-8");
        $this->dom->formatOutput = true;
        $this->shows = $shows;
    }

    /**
     * Creates a new XML file based on the $shows property and writes it to a file.
     * @param string $file The XML file name.
     * @throws DOMException Throws a DOMException when an error occurs.
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
