<?php

class XMLPullParse {
    private $parser;
    private $depth;
    private $currentElement;

    public function __construct() {
        $this->parser = new XMLReader();
        $this->currentElement = null;
    }

    public function __destruct() {
        $this->parser->close();
    }

    public function parse($file) {
        $this->parser->open($file);

        while ($this->parser->read()) {
            switch ($this->parser->nodeType) {
                case XMLReader::ELEMENT:
                    $this->currentElement = $this->parser->name;
                    $line = $this->parser->expand()->getLineNo();
                    for ($i = 0; $i < $this->parser->depth; $i++) {
                        echo "&nbsp;&nbsp;";
                    }
                    echo "$line: " . $this->parser->name;

                    switch ($this->currentElement) {
                        case "rezept":
                            echo ": " . $this->parser->getAttribute("quelle") . "<br>";
                            break;
                        case "zutaten":
                        case "zutat":
                        case "zubereitung":
                            echo "<br>";
                            break;
                    }
                    break;
                case XMLReader::END_ELEMENT:
                    $this->currentElement = null;
                    break;
                case XMLReader::TEXT:
                    switch ($this->currentElement) {
                        case "gericht":
                        case "ingredienz":
                        case "menge":
                        case "einheit":
                        case "schritt":
                            echo ": " . trim($this->parser->value) . "<br>";
                    }
                    break;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>XML Pull-Parser</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Output:</h1>

<p>
    <?php
    $xmlparse = new XMLPullParse();
    $xmlparse->parse("rezept.xml");
    ?>
</p>
</body>
</html>