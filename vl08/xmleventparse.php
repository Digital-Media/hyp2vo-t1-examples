<?php

class XMLEventParse
{
    private $parser;
    private $isParsing;
    private $depth;
    private $currentElement;

    private $gericht;
    private $zutat;
    private $schritt;

    public function __construct()
    {
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);

        xml_set_element_handler($this->parser, "startElement", "endElement");
        xml_set_character_data_handler($this->parser, "characterData");

        $this->isParsing = false;
        $this->depth = 0;
        $this->currentElement = null;

        $this->gericht = null;
        $this->zutat = [];
        $this->schritt = null;
    }

    public function __destruct()
    {
        if ($this->isParsing) {
            xml_parse($this->parser, null, true);
        }
        xml_parser_free($this->parser);
    }

    public function parse($file)
    {
        $this->isParsing = true;
        $fp = null;

        if (!$fp = fopen($file, "r")) {
            die("XML Input nicht lesbar");
        }

        while ($data = fread($fp, 4096)) {
            if (!xml_parse($this->parser, $data, feof($fp))) {
                die(xml_error_string(xml_get_error_code($this->parser)) . xml_get_current_line_number($this->parser));
            }
        }

        $this->isParsing = false;
    }

    public function startElement($parser, $tag, $attributes)
    {
        $this->currentElement = $tag;
        $line = xml_get_current_line_number($this->parser);

        for ($i = 0; $i < $this->depth; $i++) {
            echo "&nbsp;&nbsp;";
        }
        echo "$line: $tag";

        $this->depth++;

        switch ($this->currentElement) {
            case "rezept":
                $quelle = $attributes["quelle"];
                echo ": $quelle" . "<br>";
                break;
            case "zutat":
                $this->zutat["ingredienz"] = "";
                $this->zutat["menge"] = "";
                $this->zutat["einheit"] = "";
                echo "<br>";
                break;
            case "zutaten":
            case "zubereitung":
                echo "<br>";
                break;
        }
    }

    public function endElement($parser, $tag)
    {
        switch ($this->currentElement) {
            case "gericht":
                echo ": " . $this->gericht . "<br>";
                break;
            case "ingredienz":
            case "menge":
            case "einheit":
                echo ": " . $this->zutat[$this->currentElement] . "<br>";
                break;
            case "schritt":
                echo ": " . $this->schritt . "<br>";
                break;
        }

        $this->schritt = null;
        $this->depth--;
        $this->currentElement = null;
    }

    public function characterData($parser, $data)
    {
        switch ($this->currentElement) {
            case "gericht":
                $this->gericht .= trim($data);
                break;
            case "ingredienz":
            case "menge":
            case "einheit":
                $this->zutat[$this->currentElement] .= trim($data);
                break;
            case "schritt":
                $this->schritt .= $data;
                break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Eventbasierter XML-Parser</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Output:</h1>

<p>
    <?php
    $xmlParse = new XMLEventParse();
    $xmlParse->parse("rezept.xml");
    ?>
</p>
</body>
</html>
