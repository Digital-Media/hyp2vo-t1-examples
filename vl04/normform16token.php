<?php
/**
 * Das PHP-Normformular mit Token dient zur Erfassung, Verarbeitung und Validierung von Formulardaten und verhindert doppelte Uploads.
 *
 * Das PHP-Normformular stellt einen standardisierten Ablauf zur Erfassung, Valisierung und Verarbeitung von Formulareingaben dar.
 * All diese Prozesse findet dabei in einer einzigen PHP-Datei statt. Zunächst wird beim initialen Aufruf das Formular angezeigt -
 * es können Daten eingegeben werden. Nach dem Absenden werden diese auf Korrektheit überprüft. Traten fehlerhafte Eingaben auf,
 * wird das Formular erneut vorgelegt und entsprechende Fehlermeldungen angezeigt. Wurde das Formular korrekt ausgefüllt, wird die
 * Ergbenisseite angezeigt. Das PHP-Normformular stellt weiterhin sicher, dass Eingaben von BenutzerInnen überprüft und bereinigt
 * werden, sodass Angriffe wie Cross-Site-Scripting ausgeschlossen werden. Das Token-System verhindert doppelte Uploads.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */

/**
 * Konstante zur Benennung und Identifikation des Namen-Felds.
 */
define("NAME", "name");
/**
 * Konstante zur Benennung und Identifikation der zu speichernden Datei.
 */
define("FILENAME", "data.txt");
/**
 * Konstante zur Benennung und Identifikation des Token-Felds.
 */
define("TOKEN", "_token");

/**
 * Startet die Session bzw. nimmt sie wieder auf
 */
session_start();

/**
 * Erzeugt ein eindeutiges und einzigartiges Token, speichert es in der Session und gibt ein verstecktes Token-
 * Formularfeld aus. Dieses Funktion muss innerhalb von printForm() aufgerufen werden.
 */
function printToken() {
    $token = uniqid(session_id());
    $_SESSION[TOKEN] = $token;
    echo '<input type="hidden" name="' . TOKEN . '" value="' . $token . '">' . PHP_EOL;
}

/**
 * Überprüft, ob die Token-Werte im Request und in der Session existieren und vergleicht diese.
 * @return bool Gibt <pre>true</pre> zurück, wenn beide Werte existieren und gleich sind, sonst <pre>false</pre>.
 */
function isTokenValid() {
    return (strlen($_POST[TOKEN]) > 0 && isset($_SESSION[TOKEN]) && strcmp($_POST[TOKEN], $_SESSION[TOKEN]) === 0);
}

/**
 * Entfernt das Token aus der Session und markiert es damit als ungültig.
 */
function invalidateToken() {
    unset($_SESSION[TOKEN]);
}


/**
 * Diese Funktion filtert ungewünschte HTML-Tags aus einem String und gibt den gefilterten Text zurück.
 * @param string $str Der Eingabestring mit möglichen, zu filternden HTML-Inhalten.
 * @return string Der gefilterte String, der gefahrlos weiterverwendet werden kann.
 */
function sanitizeFilter($str) {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5);
}

/**
 * Gibt den Kopfbereich des HTML-Dokuments aus, das zum Anzeigen des Formulars oder des Ergebnisses verwendet wird.
 * @param string $pageTitle Der Titel der Seite, wie er im <title>-Element erscheinen soll.
 */
function printHeader($pageTitle) {
    ?>
    <!DOCTYPE html>
    <html lang="de">
    <head>
        <meta charset="utf-8">
        <title><?= $pageTitle; ?></title>
    </head>
    <body>
    <?php
}

/**
 * Gibt den Abschluss des HTML-Dokuments aus, das zum Anzeigen des Formulars oder des Ergebnisses verwendet wird.
 */
function printFooter() {
    ?>
    </body>
    </html>
    <?php
}

/**
 * Überprüft, ob in $_POST bereits ein Wert für das angegebenen Formularfeld existiert. Wenn ja, wird dieser Wert
 * gefiltert zurückgegeben, ansonsten ein leerer String. Diese Funktion übernimmt somit das Befüllen bereits
 * ausfgefüllter Formularfelder nach einem erfolglosen Absenden. Mittels {@link sanitizeFilter()} werden schadhafte Eingaben
 * bereinigt, trim() dient zum Entfernen ungewünschter Leerzeichen am Anfang und am Ende.
 * @param string $name Der Name des Formularfelds, das überprüft werden soll.
 * @return string Der vorausgefüllte Wert des Formularfelds oder ein leerer String (falls es zuvor noch leer war).
 */
function param($name) {
    return isset($_POST[$name]) ? trim(sanitizeFilter($_POST[$name])) : "";
}

/**
 * Gibt alle Fehlermeldungen aus, die beim Validieren des Formulars aufgetreten sind.
 */
function printErrMsg() {
    global $errMsg;

    if (isset($errMsg)) {
        echo "<p>Bitte folgende Fehler korrigieren:</p>" . PHP_EOL;
        echo "<ul>" . PHP_EOL;
        foreach ($errMsg as $e) {
            echo "<li>$e</li>" . PHP_EOL;
        }
        echo "</ul>" . PHP_EOL;
    }
}

/**
 * Übernimmt die Ausgabe und Anzeige des gesamten Formularfelds. Falls von einem vorigen Absenden noch Werte vorhanden
 * sind, werden diese über die Funktion {@link param()} wieder eingefügt, ebenso werden mögliche anzuzeigenden
 * Fehlermeldungen mittels {@link printErrMsg()} ausgegeben. Um den HTML-Grundstock auszugeben, werden
 * {@link printHeader()} und {@link printFooter()} am Beginn bzw. Ende aufgerufen.
 */
function printForm() {
    printHeader("PHP-Normformular mit Token");
    ?>

    <h1>Normformular mit Token</h1>
    <p>Bitte um Ihre Angaben, mit "*" markierte Felder müssen ausgefüllt werden.</p>

    <?php
    printErrMsg();
    ?>
    <form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
        <div>
            <label for="<?= NAME ?>">Name: *</label><br>
            <input type="text" name="<?= NAME ?>" id="<?= NAME ?>" value="<?= param(NAME) ?>">
        </div>

        <?php printToken(); ?>

        <button type="submit">Absenden</button>
    </form>

    <?php
    printFooter();
}

/**
 * Überprüft, ob der Inhalt eines Formularfelds beim Absenden leer war, d.h. nichts außer evtl. Whitespaces enthalten
 * hat. Existiert (aus welchem Grund auch immer) der Eintrag im $_POST-Array nicht, wird das Feld ebenfalls als leer angesehen.
 * @param string $name Der Name des zu überprüfenden Formularfelds.
 * @return bool Gibt <pre>true</pre> zurück, falls das Formularfeld leer war, sonst <pre>false</pre>.
 */
function isEmpty($name) {
    if (isset($_POST[$name])) {
        return (strlen(trim($_POST[$name])) === 0);
    }
    return true;
}

/**
 * Überprüft, ob das Formularfeld korrekt ausgefüllt wurde. Die Kriterien werden in dieser Funktion anhand verschiedener
 * if-Bedingungen selbst angegeben. Schlägt ein Kriterium fehl, wird ein Eintrag in das globale Array <pre>$errMsg</pre>
 * geschrieben.
 * @global array $errMsg Beinhaltet mögliche Fehlermeldungen, die bei der Validierung aufgetreten sind und später
 * ausgegeben werden.
 * @return bool Gibt <pre>true</pre> zurück, wenn alle Kriterien erfüllt wurden, ansonsten <pre>false</pre>.
 */
function isValidForm() {
    global $errMsg;

    if (!isTokenValid()) {
        $errMsg[TOKEN] = "Formular wurde erneut abgesendet.";
    }

    invalidateToken();

    if (isEmpty(NAME)) {
        $errMsg[NAME] = "Name fehlt.";
    }

    return !isset($errMsg);
}

/**
 * Hängt einen neuen Eintrag, bestehend aus Name und aktuellem Datum, in die spezifizierte Datei dazu.
 * @param string $filename Die Datei, in die geschrieben werden soll.
 * @param string $data Die neu hinzuzufügenden Daten.
 */
function appendToFile($filename, $data) {
    $line = $data . "|" . date("d.m.Y H:i:s") . PHP_EOL;

    $fp = fopen($filename, "a");
    $lock = flock($fp, LOCK_EX);
    if ($lock) {
        fwrite($fp, $line);
        flock($fp, LOCK_UN);
    }
    fclose($fp);
}

/**
 * Gibt den Inhalt der angegebenen Datei als Tabelle aus.
 * @param string $filename Die auszulesende und auszugebende Datei.
 */
function displayFileContents($filename) {
    $fp = fopen($filename, "r");
    $lock = flock($fp, LOCK_SH);
    if ($lock) {
        echo '<table border="1">' . PHP_EOL;
        $line = fgetcsv($fp, 1024, "|");
        while (!feof($fp)) {
            echo "<tr>" . PHP_EOL;
            foreach ($line as $field) {
                echo "<td>" . sanitizeFilter($field) . "</td>" . PHP_EOL;
            }
            echo "</tr>" . PHP_EOL;
            $line = fgetcsv($fp, 1024, "|");
        }
        echo "</table>" . PHP_EOL;
        flock($fp, LOCK_UN);
    }
    fclose($fp);
}

/**
 * Gibt die Ergebnisseite aus. Dazu werden zunächst wieder die Funktionen {@link printHeader()} und
 * {@link printFooter()} am Beginn bzw. Ende aufgerufen, dazwischen werden die eigentlichen Inhalte ausgegeben.
 * In diesem Grundgerüst wird lediglich der Inhalt der Variable <pre>$_POST</pre> ausgegeben, hier wird jedoch in der
 * Regel sinnvollerer Inhalt stehen.
 */
function processForm() {
    printHeader("PHP-Normformular mit Token Resultat");
    ?>

    <h1>Normformular mit Token Resultat</h1>

    <?php
    appendToFile(FILENAME, $_POST[NAME]);
    displayFileContents(FILENAME);

    printFooter();
}


/**
 * Überprüft, ob es sich beim aktuellen Aufruf der Seite um einen neuen, d.h. initialen Aufruf handelt, oder ob die
 * Seite durch das Absenden des Formulars erneut aufgerufen wurde. Ein initialer Aufruf erfolgt immer über die GET-
 * Übertragungsmethode, beim Absenden des Formulars wird POST verwendet.
 * @return bool Gibt <pre>true</pre> zurück, wenn es sich um ein abgesendets Formular handelt, sonst <pre>false</pre>.
 */
function isFormSubmission() {
    return ($_SERVER["REQUEST_METHOD"] === "POST");
}

/**
 * Die Hauptfunktion des Normformulars. Hier befindet sich der Entscheidungsbaum, der überprüft, ob es sich um einen
 * initialen Aufruf oder um ein abgesendetes Formular handelt (mittels {@link isFormSubmission()}) und entweder das
 * Formular anzeigt (mittels {@link printForm()}) oder zunächst das Formular validiert ({@link isValidForm()}) und bei
 * Korrektheit das Ergebnis anzeigt ({@link processForm()}) oder sonst wieder das Formular vorlegt
 * ({@link printForm()}).
 */
function normForm() {
    if (isFormSubmission()) {
        if (isValidForm()) {
            processForm();
        }
        else {
            printForm();
        }
    }
    else {
        printForm();
    }
}


/**
 * Hauptaufruf - dies ist der Startpunkt des Normformular-Ablaufs.
 */
normForm();