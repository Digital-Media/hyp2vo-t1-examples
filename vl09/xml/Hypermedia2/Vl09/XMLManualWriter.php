<?php

namespace Hypermedia2\Vl09;

/**
 * Creates a new XML file based on the data created in the constructor without any library.
 *
 * @package Hypermedia2\Ue09
 */
class XMLManualWriter
{
    // Document data properties

    /**
     * The data used for creating the XML file.
     *
     * @var array
     */
    private array $shows;

    /**
     * Initializes the data used for XML creation.
     */
    public function __construct()
    {
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
     * Creates a new XML file based on the $shows property and displays it in the browser.
     */
    public function generateXML(): void
    {
        header("Content-Type: text/xml");
        echo '<?xml version="1.0" ?>' . PHP_EOL;
        echo "<shows>" . PHP_EOL;

        foreach ($this->shows as $show) {
            echo "<show>" . PHP_EOL;
            foreach ($show as $tag => $data) {
                echo "<$tag>" . htmlspecialchars($data) . "</$tag>" . PHP_EOL;
            }
            echo "</show>" . PHP_EOL;
        }
        echo "</shows>" . PHP_EOL;
    }
}
