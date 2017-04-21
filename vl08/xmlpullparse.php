<?php

class XMLPullParse
{
    private $parser;
    private $depth;

    public function __construct()
    {
        $this->parser = new XMLReader();
    }

    public function __destruct()
    {
        $this->parser->close();
    }

    public function parse($file)
    {
        $this->parser->open($file);

        while ($this->parser->read()) {
            if ($this->parser->nodeType === XMLReader::ELEMENT) {
                $line = $this->parser->expand()->getLineNo();
                for ($i = 0; $i < $this->parser->depth; $i++) {
                    echo "&nbsp;&nbsp;";
                }
                echo "$line: " . $this->parser->name;

                switch ($this->parser->name) {
                    case "rezept":
                        echo ": " . $this->parser->getAttribute("quelle") . "<br>";
                        break;
                    case "gericht":
                    case "ingredienz":
                    case "menge":
                    case "einheit":
                    case "schritt":
                        echo ": " . trim($this->parser->readString()) . "<br>";
                        break;
                    case "zutaten":
                    case "zutat":
                    case "zubereitung":
                        echo "<br>";
                        break;
                }
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
    $xmlParse = new XMLPullParse();
    $xmlParse->parse("rezept.xml");
    ?>
</p>
</body>
</html>
