<?php

namespace Hypermedia2\Vl09;

use SimpleXMLElement;

/**
 * Creates a new object oriented parser based on SimpleXML and parses the XML Tirolerknödel recipe.
 *
 * @package Hypermedia2\Vl09
 */
class XMLOoSimpleParser
{
    // Parser related properties

    /**
     * The SimpleXML element containing the whole document.
     *
     * @var SimpleXMLElement
     */
    private SimpleXMLElement $xml;

    // Document related properties

    /**
     * The URL source of the recipe.
     *
     * @var string
     */
    private string $source;

    /**
     * The name of the current dish.
     *
     * @var string
     */
    private string $dish;

    /**
     * The list of ingredients.
     *
     * @var array
     */
    private array $ingredients;

    /**
     * The list of preparation steps.
     *
     * @var array
     */
    private array $steps;

    /**
     * Initializes properties for data storage.
     */
    public function __construct()
    {
        $this->ingredients = [];
        $this->steps = [];
    }

    /**
     * Parses the XML file and writes its values into the respective properties.
     *
     * @param string $file
     */
    public function parse(string $file): void
    {
        $this->xml = simplexml_load_file($file);

        /*ini_set('xdebug.var_display_max_depth', 10);
        var_dump($this->xml);*/

        $attributes = $this->xml->attributes();
        $this->source = $attributes["quelle"];

        $this->dish = $this->xml->gericht;

        foreach ($this->xml->zutaten->zutat as $ingredient) {
            $this->ingredients[] = [
                "ingredienz" => $ingredient->ingredienz,
                "menge" => $ingredient->menge,
                "einheit" => $ingredient->einheit
            ];
        }

        foreach ($this->xml->zubereitung->schritt as $step) {
            $this->steps[] = $step;
        }
    }

    /**
     * Returns the source URL once it's been parsed.
     *
     * @return string The source URL.
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Returns the dish once it's been parsed.
     *
     * @return string The name of the dish.
     */
    public function getDish(): string
    {
        return $this->dish;
    }

    /**
     * Returns the list of ingredients once they've been parsed.
     *
     * @return array The list of ingredients.
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * Returns the list of preparation steps once they've been parsed.
     *
     * @return array The list of preparation steps.
     */
    public function getSteps(): array
    {
        return $this->steps;
    }
}
