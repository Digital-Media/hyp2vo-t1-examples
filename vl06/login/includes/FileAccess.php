<?php

/**
 * Implements base functionality for reading data from a file.
 *
 * This class is is able to read a JSON file (e.g. for user information) and
 * store the retrieved data in a two-dimensional array.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */
class FileAccess
{
    /**
     * @var string DATA_DIRECTORY Sets the directory where the meta data (JSON files) for images and users is stored.
     */
    const DATA_DIRECTORY = "data/";

    /**
     * @var string USER_DATA_PATH The full path for the user meta data JSON file.
     */
    const USER_DATA_PATH = self::DATA_DIRECTORY . "userdata.json";

    /**
     * Creates a new FileAccess object.
     */
    public function __construct()
    {
        // Intentionally left empty.
    }

    /**
     * Loads the contents of a JSON file (the user data) into an according two-dimensional array. The method uses
     * file_get_contents to read the whole file into a string and the create an array using json_decode. A file lock has
     * to be obtained since file_get_contents does not implement this by itself.
     * @param string $filename The file that is to be read.
     * @return array Returns a two-dimensional array with the information of the JSON file. The array keys are the JSON
     * keys.
     */
    public function loadContents(string $filename): array
    {
        $data = [];
        if (file_exists($filename)) {
            $fp = fopen($filename, "r");
            $lock = flock($fp, LOCK_SH);
            if ($lock) {
                $data = json_decode(file_get_contents($filename), true) ?? [];
            }
            flock($fp, LOCK_UN);
            fclose($fp);
        }
        return $data;
    }
}
