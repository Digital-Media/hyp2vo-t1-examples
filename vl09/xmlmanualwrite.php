<?php

class XMLManualWrite
{
    private $shows;

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

    public function generateXML()
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

$xmlWrite = new XMLManualWrite();
$xmlWrite->generateXML();
