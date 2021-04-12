<?php

namespace LoginExample;

/**
 * Implements base functionality for reading data from a file and writing data into a file.
 *
 * This class is is able to read a JSON file (e.g., for user information) and store the retrieved data in a
 * two-dimensional array as well as write a two-dimensional array back into a file.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2021
 */
class FileAccess
{
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

    /**
     * Writes a two-dimensional array of data into a JSON file. Works with both image meta data and user meta data. The
     * method uses file_put_contents to write a string into a file that is being created by json_encode. JSON output is
     * pretty printed, an exclusive file lock is obtain to avoid problems with concurrent access.
     * @param string $filename The file to be written.
     * @param array $data The array of data that is read.
     * @return bool Returns true if the operation was successful, otherwise false;
     */
    public function storeContents(string $filename, array $data): bool
    {
        if (!file_exists(dirname($filename))) {
            if (!mkdir(dirname($filename))) {
                return false;
            }
        }

        $bytes = file_put_contents($filename, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), LOCK_EX);

        if ($bytes > 0) {
            return true;
        }

        return false;
    }
}
