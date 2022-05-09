<?php

namespace Hypermedia2\Vl09;

use XMLReader;

/**
 * Creates a new pull parser based on XMLReader and parses the XML Tirolerknödel recipe.
 * @package Hypermedia2\Vl09
 */
class XMLPullParser
{
    // Parser related properties

    /**
     * The XML event parser instance.
     * @var XMLReader
     */
    private XMLReader $parser;

    // Document related properties

    /**
     * The URL source of the recipe.
     * @var string
     */
    private string $source;

    /**
     * The name of the current dish.
     * @var string
     */
    private string $dish;

    /**
     * The list of ingredients.
     * @var array
     */
    private array $ingredients;

    /**
     * The list of preparation steps.
     * @var array
     */
    private array $steps;

    /**
     * Creates a new parser instance and initializes properties.
     */
    public function __construct()
    {
        $this->parser = new XMLReader();
        $this->ingredients = [];
        $this->steps = [];
    }

    /**
     * Destroys the parser instance by closing it.
     */
    public function __destruct()
    {
        $this->parser->close();
    }

    /**
     * Parses the XML file and writes its values into the respective properties.
     * @param string $file The file to be parsed.
     */
    public function parse(string $file): void
    {
        $this->parser->open($file);

        while ($this->parser->read()) {
            if ($this->parser->nodeType === XMLReader::ELEMENT) {
                switch ($this->parser->name) {
                    case "rezept":
                        $this->source = $this->parser->getAttribute("quelle");
                        break;
                    case "gericht":
                        $this->dish = trim($this->parser->readString());
                        break;
                    case "zutat":
                        $this->ingredients[] = [];
                        break;
                    case "ingredienz":
                    case "menge":
                    case "einheit":
                        $this->ingredients[count($this->ingredients) - 1][$this->parser->name] = trim(
                            $this->parser->readString()
                        );
                        break;
                    case "schritt":
                        $this->steps[] = trim($this->parser->readString());
                        break;
                }
            }
        }
    }

    /**
     * Returns the source URL once it's been parsed.
     * @return string The source URL.
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Returns the dish once it's been parsed.
     * @return string The name of the dish.
     */
    public function getDish(): string
    {
        return $this->dish;
    }

    /**
     * Returns the list of ingredients once they've been parsed.
     * @return array The list of ingredients.
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * Returns the list of preparation steps once they've been parsed.
     * @return array The list of preparation steps.
     */
    public function getSteps(): array
    {
        return $this->steps;
    }
}
