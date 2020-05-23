<?php

namespace Hypermedia2\Vl11;

/**
 * Contains dummy data that is being searched using the search suggest feature.
 * This class serves as a simple data source that is being used for the search suggest feature. Since this example does
 * not work with actual data, you can define the strings that are being queried here.
 */
class SearchData
{
    /**
     * The titles that are queried by the search suggest feature.
     * @var array
     */
    private array $titles;

    /**
     * Fills the data array with a series of strings that are being queried by the search suggest feature.
     */
    public function __construct()
    {
        $this->titles = [
            "Die FH",
            "HM2",
            "FH",
            "Hagenberg",
            "jQuery",
            "Medientechnik und -design",
            "MTD19",
            "MTD",
            "PHP",
            "JavaScript",
            "Österreich",
            "Bla",
            "Gut/Böse"
        ];
    }

    /**
     * Perform a search in the data based on a given string and return the data as JSON string.
     * @param string $searchString The search term.
     * @return string The results as JSON data.
     */
    public function search(string $searchString): string
    {
        $jsonResponse["words"] = [];
        foreach ($this->titles as $entry) {
            if (mb_stripos($entry, $searchString, 0, "UTF-8") !== false) {
                $jsonResponse["words"][] = $entry;
            }
        }
        sort($jsonResponse["words"]);
        $jsonResponse["count"] = count($jsonResponse["words"]);

        return json_encode($jsonResponse);
    }

    /**
     * Return all the stored titles in the form of an array.
     * @return array Alls stored titles.
     */
    public function getTitles(): array
    {
        return $this->titles;
    }
}
