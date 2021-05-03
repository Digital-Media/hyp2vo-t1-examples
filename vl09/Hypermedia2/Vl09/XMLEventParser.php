<?php

namespace Hypermedia2\Vl09;

/**
 * Creates a new event based (SAX) parser and parses the XML Tirolerknödel recipe.
 *
 * @package Hypermedia2\Vl09
 */
class XMLEventParser
{
    // Parser related properties

    /**
     * The XML event parser instance.
     *
     * @var resource
     */
    private $parser;

    /**
     * Keeps track if the parser is currently working in order to avoid premature destruction.
     *
     * @var bool
     */
    private bool $isParsing;

    /**
     * Keeps track of the currently "opened" element in order to by able to correctly assign the character data.
     *
     * @var string|null
     */
    private ?string $currentElement;

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
     * Creates a new parser instance, assigns the handler callbacks and initializes properties.
     */
    public function __construct()
    {
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);

        xml_set_element_handler($this->parser, "startElement", "endElement");
        xml_set_character_data_handler($this->parser, "characterData");

        $this->isParsing = false;
        $this->currentElement = null;

        $this->source = "";
        $this->dish = "";
        $this->ingredients = [];
        $this->steps = [];
    }

    /**
     * Destroys the parser instance. Stops the parser if it's currently running.
     */
    public function __destruct()
    {
        if ($this->isParsing) {
            xml_parse($this->parser, null, true);
        }
        xml_parser_free($this->parser);
    }

    /**
     * Parses the XML file and writes its values into the respective properties.
     *
     * @param string $file The XML file to be parsed.
     */
    public function parse(string $file): void
    {
        if (!$fp = fopen($file, "r")) {
            die("XML input not readable");
        }

        $this->isParsing = true;

        while ($data = fread($fp, 4096)) {
            if (!xml_parse($this->parser, $data, feof($fp))) {
                die(xml_error_string(xml_get_error_code($this->parser)) . xml_get_current_line_number($this->parser));
            }
        }

        $this->isParsing = false;
    }

    /**
     * The callback for opening XML tags.
     *
     * @param resource $parser The parser instance.
     * @param string $tag The name of the opening element.
     * @param array $attributes The list of attributes present.
     */
    public function startElement($parser, string $tag, array $attributes): void
    {
        $this->currentElement = $tag;

        switch ($tag) {
            case "rezept":
                $this->source = $attributes["quelle"];
                break;
            case "zutat":
                $this->ingredients[] = [];
                break;
            case "schritt":
                $this->steps[] = "";
                break;
        }
    }

    /**
     * The callback for closing XML tags.
     *
     * @param resource $parser The parser instance.
     * @param string $tag The name of the closing element.
     */
    public function endElement($parser, string $tag): void
    {
        $this->currentElement = null;
    }

    /**
     * The callback for character data.
     *
     * @param resource $parser The parser instance.
     * @param string $data The character data.
     */
    public function characterData($parser, string $data): void
    {
        switch ($this->currentElement) {
            case "gericht":
                $this->dish .= trim($data);
                break;
            case "ingredienz":
            case "menge":
            case "einheit":
                $this->ingredients[count($this->ingredients) - 1][$this->currentElement] .= trim($data);
                break;
            case "schritt":
                $this->steps[count($this->steps) - 1] .= $data;
                break;
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
