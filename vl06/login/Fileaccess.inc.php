<?php

/**
 * Übernimmt das Auslesen der BenutzerInnen-Daten aus einer Textdatei und gibt diese als zweidimensionales Array
 * zurück.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */
class FileAccess {
    /**
     * @var string Der Name der Textdatei in der die NutzerInnen-Daten gespeichert sind.
     */
    const USERFILE = "users.txt";

    /**
     * @var array $users Das Array mit den BenutzerInnen-Daten, welches aus der Textdatei befüllt wird.
     */
    private $users;

    /**
     * Beim Erzeugen des Objekts wird das Array mit den NutzerInnen-Daten initialisiert/gelöscht.
     */
    public function __construct() {
        $this->users = [];
    }

    /**
     * Gibt das Array mit den NutzerInnen-Daten zurück.
     * @return array Das Array mit den Benutzername/Passwort-Kombinationen.
     */
    public function getUsers() {
        $this->loadContents();
        return $this->users;
    }

    /**
     * Lädt den Inhalt der Textdatei in das zweidimensionale Array.
     */
    public function loadContents() {
        $this->users = [];
        if (file_exists(self::USERFILE)) {
            $contents = file(self::USERFILE);
            foreach ($contents as $line) {
                $this->users[] = explode("|", trim($line));
            }
        }
    }
}