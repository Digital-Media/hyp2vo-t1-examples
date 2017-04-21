<?php

class XMLOoDomParse
{
    private $dom;

    public function __construct()
    {
        $this->dom = new DOMDocument();
    }

    public function parse($file)
    {
        $this->dom->load($file);

        //$this->processNode($this->dom->documentElement);

        $rezept = $this->dom->documentElement;
        echo $rezept->nodeName . ": " . $rezept->getAttribute("quelle") . "<br>";

        $zutaten = $this->dom->getElementsByTagName("zutaten")->item(0);
        echo $zutaten->nodeName . "<br>";

        $zutat = $this->dom->getElementsByTagName("zutat");
        foreach ($zutat as $item) {
            echo $item->nodeName . "<br>";
            $children = $item->childNodes;
            foreach ($children as $child) {
                if ($child->nodeType === XML_ELEMENT_NODE) {
                    echo $child->nodeName . ": " . $child->firstChild->nodeValue . "<br>";
                }
            }
        }

        $zubereitung = $this->dom->getElementsByTagName("zubereitung")->item(0);
        echo $zubereitung->nodeName . "<br>";

        $schritt = $this->dom->getElementsByTagName("schritt");
        foreach ($schritt as $item) {
            echo $item->nodeName . ": " . $item->firstChild->nodeValue . "<br>";
        }
    }

    /*private function processNode($node)
    {
        if ($node->nodeType === XML_ELEMENT_NODE) {
            echo $node->getLineNo() . ": " . $node->nodeName;
            switch ($node->nodeName) {
                case "rezept":
                    echo ": " . $node->getAttribute("quelle") . "<br>";
                    break;
                case "zutaten":
                case "zutat":
                case "zubereitung":
                    echo "<br>";
            }
        }
        if ($node->nodeType === XML_TEXT_NODE) {
            $content = trim($node->nodeValue);
            if (!empty($content)) {
                echo ": " . $content . "<br>";
            }
        }
        if ($node->hasChildNodes()) {
            foreach ($node->childNodes as $n) {
                $this->processNode($n);
            }
        }
    }*/
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>DOM Parser</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Output:</h1>

<p>
    <?php
    $xmlParse = new XMLOoDomParse();
    $xmlParse->parse("rezept.xml");
    ?>
</p>
</body>
</html>
