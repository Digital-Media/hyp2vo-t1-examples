<?php
namespace Hypermedia2\Vl09;

use DOMDocument;

/**
 * Creates a new object oriented parser based on DOM and parses the XML Tirolerknödel recipe.
 *
 * @package Hypermedia2\Ue09
 */
class XMLOoDomParser
{
    // Parser related properties

    /**
     * The DOMDocument element containing the whole document.
     *
     * @var DOMDocument
     */
    private $dom;

    // Document related properties

    /**
     * The URL source of the recipe.
     *
     * @var string
     */
    private $source;

    /**
     * The name of the current dish.
     *
     * @var string
     */
    private $dish;

    /**
     * The list of ingredients.
     *
     * @var array
     */
    private $ingredients;

    /**
     * The list of preparation steps.
     *
     * @var array
     */
    private $steps;

    /**
     * Creates a new DOM instances and initializes properties for data storage.
     */
    public function __construct()
    {
        $this->dom = new DOMDocument();
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
        $this->dom->load($file);

        $this->source = $this->dom->documentElement->getAttribute("quelle");

        $this->dish = $this->dom->getElementsByTagName("gericht")->item(0)->nodeValue;

        foreach ($this->dom->getElementsByTagName("zutat") as $ingredient) {
            $this->ingredients[] = [];
            $children = $ingredient->childNodes;
            foreach ($children as $child) {
                if ($child->nodeType === XML_ELEMENT_NODE) {
                    $this->ingredients[count($this->ingredients) - 1][$child->nodeName] = $child->nodeValue;
                }
            }
        }

        foreach ($this->dom->getElementsByTagName("schritt") as $step) {
            $this->steps[] = $step->nodeValue;
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
