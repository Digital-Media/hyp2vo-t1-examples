<?php

/**
 * PHP-basiertes Login-Beispiel
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2015
 */

require_once("session.inc.php");
require("TNormform16.inc.php");

/**
 * Repräsentiert die Hauptseite, die erst durch einen erfolgreichen Login betreten werden kann. Die Methoden sind
 * absichtlich leer - in diesem Minimalbeispiel ist der Inhalt vollständig in die Templates augelagert.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */
class MainPage extends TNormForm {
    /**
     * Bereitet im Normalfall die Inhalte des Formularfeldes auf. Hier gibt es keine.
     */
    protected function prepareFormFields() {
        // Absichtlich leer. Alle Inhalte befinden sich im Template.
    }

    /**
     * Validiert im Normalfall eingaben. Hier gibt es keine.
     */
    protected function isValidForm() {
        // Absichtlich leer. Diese Seite verarbeitet keine Eingaben, daher ist auch nichts zu validieren.
    }

    /**
     * Zeigt im Normalfall das Ergebnis an. Wird vom Template erledigt.
     */
    protected function processForm() {
        // Absichtlich leer. Alle Inhalte befinden sich im Template.
    }
}

$form = new MainPage();
$form->normForm();