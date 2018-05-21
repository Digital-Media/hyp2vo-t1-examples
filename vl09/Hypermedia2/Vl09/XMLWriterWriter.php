<?php
namespace Hypermedia2\Vl09;

use XMLWriter;

/**
 * Creates a new XML file based on the data created in the constructor using XMLWriter.
 *
 * @package Hypermedia2\Vl09
 */
class XMLWriterWriter
{
    // Writer related properties

    /**
     * The XMLWriter instance.
     *
     * @var XMLWriter
     */
    private $writer;

    // Document data properties

    /**
     * The data used for creating the XML file.
     *
     * @var array
     */
    private $shows;

    /**
     * Initializes the writer and the data used for XML creation.
     */
    public function __construct()
    {
        $this->writer = new XMLWriter();

        $this->shows = [
                [
                        "name"   => "Die Simpsons",
                        "kanal"  => "FOX",
                        "beginn" => "20:00",
                        "dauer"  => "20"
                ],
                [
                        "name"   => "Game of Thrones",
                        "kanal"  => "HBO",
                        "beginn" => "21:00",
                        "dauer"  => "60"
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
