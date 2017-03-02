<?php

require_once("Smarty.class.php");

/**
 * Das objektorientierte und templatebasierte PHP-Normformular dient zur Erfassung, Verarbeitung und Validierung von Formulardaten.
 *
 * Das objektorientierte und templatebasierte PHP-Normformular stellt einen standardisierten Ablauf zur Erfassung, Valisierung und
 * Verarbeitung von Formulareingaben dar.All diese Prozesse findet dabei in einer einzigen PHP-Datei statt. Zunächst wird beim
 * initialen Aufruf das Formular angezeigt - es können Daten eingegeben werden. Nach dem Absenden werden diese auf Korrektheit
 * überprüft. Traten fehlerhafte Eingaben auf, wird das Formular erneut vorgelegt und entsprechende Fehlermeldungen angezeigt.
 * Wurde das Formular korrekt ausgefüllt, wird die Ergbenisseite angezeigt. Das PHP-Normformular stellt weiterhin sicher, dass
 * Eingaben von BenutzerInnen überprüft und bereinigt werden, sodass Angriffe wie Cross-Site-Scripting ausgeschlossen werden.
 * Diese abstrakte Basisklasse enthält alle allgemeinen Methoden des Normformulars. Anwendungsspezifische Methoden (wie etwa für
 * Formularfelder oder die Generierung des Ergebnisses müssen in einer konkreten, abgeleiteten Klasse implementiert werden.
 * Diese Version des Normformulars verwendet Smarty-Templates, um HTML- von PHP-Code zu trennen.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */
abstract class TNormForm {
    /**
     * Abstrakte Methode zur Ausgabe des Formularfeldinhalts. Muss in der abgeleiteten Klasse implementiert werden.
     */
    abstract protected function prepareFormFields();

    /**
     * Abstrakte Methode zur Validierung des Formulars. Muss in der abgeleiteten Klasse implementiert werden.
     * @return bool Gibt <pre>true</pre> zurück, wenn alle Kriterien erfüllt wurden, ansonsten <pre>false</pre>.
     */
    abstract protected function isValidForm();

    /**
     * Abstrakte Methode zur Ausgabe Ergebnisses. Muss in der abgeleiteten Klasse implementiert werden.
     */
    abstract protected function processForm();

    /**
     * @var array $errMsg Speichert alle bei der Validierung auftretenden Fehlermeldungen.
     */
    protected $errMsg;

    /**
     * @var object $smarty Das Smarty-Objekt zur Arbeit mit dem Template-System.
     */
    protected $smarty;

    /**
     * Erzeugt ein neues Normform-Objekt und löscht bzw. initialisiert dabei das Array mit den Fehlermeldungen und erzeugt ein
     * neues Smarty-Objekt.
     */
    public function __construct() {
        $this->errMsg = [];
        $this->smarty = new Smarty();
    }

    /**
     * Diese Methode filtert ungewünschte HTML-Tags aus einem String und gibt den gefilterten Text zurück.
     * @param string $str Der Eingabestring mit möglichen, zu filternden HTML-Inhalten.
     * @return string Der gefilterte String, der gefahrlos weiterverwendet werden kann.
     */
    protected function sanitizeFilter($str) {
        return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5);
    }

    /**
     * Überprüft, ob in $_POST bereits ein Wert für das angegebenen Formularfeld existiert. Wenn ja, wird dieser Wert
     * gefiltert zurückgegeben, ansonsten ein leerer String. Diese Methode übernimmt somit das Befüllen bereits
     * ausfgefüllter Formularfelder nach einem erfolglosen Absenden. Mittels {@link sanitizeFilter()} werden schadhafte Eingaben
     * bereinigt, trim() dient zum Entfernen ungewünschter Leerzeichen am Anfang und am Ende.
     * @param string $name Der Name des Formularfelds, das überprüft werden soll.
     * @return string Der vorausgefüllte Wert des Formularfelds oder ein leerer String (falls es zuvor noch leer war).
     */
    protected function param($name) {
        return isset($_POST[$name]) ? trim($this->sanitizeFilter($_POST[$name])) : "";
    }

    /**
     * Übernimmt die Ausgabe und Anzeige des Formularfeldes. Eventuell auftretende Fehlermeldungen werden an das
     * Template übergeben, in der Methode (@link prepareFormFields()) wird der Formularfeldinhalt vorbereitet und an
     * das Template übergeben. Das Template <pre>printForm.tpl</pre> wird schließlich angezeigt.
     */
    protected function printForm() {
        $this->smarty->assign("errorMessages", $this->errMsg);
        $this->prepareFormFields();
        $this->smarty->display("printForm.tpl");
    }

    /**
     * Überprüft, ob der Inhalt eines Formularfelds beim Absenden leer war, d.h. nichts außer evtl. Whitespaces enthalten
     * hat. Existiert (aus welchem Grund auch immer) der Eintrag im $_POST-Array nicht, wird das Feld ebenfalls als leer angesehen.
     * @param string $name Der Name des zu überprüfenden Formularfelds.
     * @return bool Gibt <pre>true</pre> zurück, falls das Formularfeld leer war, sonst <pre>false</pre>.
     */
    protected function isEmpty($name) {
        if (isset($_POST[$name])) {
            return (strlen(trim($_POST[$name])) === 0);
        }
        return true;
    }

    /**
     * Überprüft, ob es sich beim aktuellen Aufruf der Seite um einen neuen, d.h. initialen Aufruf handelt, oder ob die
     * Seite durch das Absenden des Formulars erneut aufgerufen wurde. Ein initialer Aufruf erfolgt immer über die GET-
     * Übertragungsmethode, beim Absenden des Formulars wird POST verwendet.
     * @return bool Gibt <pre>true</pre> zurück, wenn es sich um ein abgesendets Formular handelt, sonst <pre>false</pre>.
     */
    protected function isFormSubmission() {
        return ($_SERVER["REQUEST_METHOD"] === "POST");
    }

    /**
     * Die Hauptmethode des Normformulars. Hier befindet sich der Entscheidungsbaum, der überprüft, ob es sich um einen
     * initialen Aufruf oder um ein abgesendetes Formular handelt (mittels {@link isFormSubmission()}) und entweder das
     * Formular anzeigt (mittels {@link printForm()}) oder zunächst das Formular validiert ({@link isValidForm()}) und bei
     * Korrektheit das Ergebnis anzeigt ({@link processForm()}) oder sonst wieder das Formular vorlegt
     * ({@link printForm()}).
     */
    public function normForm() {
        if ($this->isFormSubmission()) {
            if ($this->isValidForm()) {
                $this->processForm();
            }
            else {
                $this->printForm();
            }
        }
        else {
            $this->printForm();
        }
    }
}