<?php

class XMLEventParse {
    private $parser;
    private $isParsing;
    private $depth;
    private $currentElement;

    private $gericht;
    private $zutat;
    private $schritt;

    public function __construct() {
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

    public function __destruct() {
        if ($this->isParsing) {
            xml_parse($this->parser, null, true);
        }
        xml_parser_free($this->parser);
    }

    public function parse($file) {
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

    public function startElement($parser, $tag, $attributes) {
        $this->currentElement = $tag;
        $line = xml_get_current_line_number($this->parser);

        for ($i = 0; $i < $this->depth; $i++) {
            echo "&nbsp;&nbsp;";
        }
        echo "$line: $tag";

        $this->depth++;

        if (strcmp($this->currentElement, "rezept") === 0) {
            $quelle = $attributes["quelle"];
            echo ": $quelle" . "<br>";
        }
        else {
            if (strcmp($this->currentElement, "zutat") === 0) {
                $this->zutat["ingredienz"] = "";
                $this->zutat["menge"] = "";
                $this->zutat["einheit"] = "";
                echo "<br>";
            }
            else {
                if (strcmp($this->currentElement, "zutaten") === 0 || strcmp($this->currentElement, "zubereitung") === 0) {
                    echo "<br>";
                }
            }
        }
    }

    public function endElement($parser, $tag) {
        if (strcmp($this->currentElement, "gericht") === 0) {
            echo ": " . $this->gericht . "<br>";
        }
        else {
            if (strcmp($this->currentElement, "ingredienz") === 0 || strcmp($this->currentElement, "menge") === 0 || strcmp($this->currentElement, "einheit") === 0) {
                echo ": " . $this->zutat[$this->currentElement] . "<br>";
            }
            else {
                if (strcmp($this->currentElement, "schritt") === 0) {
                    echo ": " . $this->schritt . "<br>";
                }
            }
        }
        $this->schritt = null;
        $this->depth--;
        $this->currentElement = null;
    }

    public function characterData($parser, $data) {
        if (strcmp($this->currentElement, "gericht") === 0) {
            $this->gericht .= trim($data);
        }
        else {
            if (strcmp($this->currentElement, "ingredienz") === 0 || strcmp($this->currentElement, "menge") === 0 || strcmp($this->currentElement, "einheit") === 0) {
                $this->zutat[$this->currentElement] .= trim($data);
            }
            else {
                if (strcmp($this->currentElement, "schritt") === 0) {
                    $this->schritt .= $data;
                }
            }
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
    $xmlparse = new XMLEventParse();
    $xmlparse->parse("rezept.xml");
    ?>
</p>
</body>
</html>