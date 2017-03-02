<?php

require_once("session.inc.php");
require_once("TNormform16.inc.php");
require_once("Fileaccess.inc.php");

/**
 * Realisiert die Login-Seite. BenutzerInnen geben Benutzername und Passwort ein. Stimmen diese mit gespeicherten Werten
 * überein, erfolgt eine Weiterleitung auf die Hauptseite <pre>index.php</php>, ansonsten wird das Login-Formular
 * erneut angezeigt.
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @package hm2
 * @version 2016
 */
class LoginForm extends TNormForm {
    /**
     * @var string Konstante zur Definition des Benutzernamen-Feldes.
     */
    const USERNAME = "username";
    /**
     * @var string Konstante zur Definition des Passwort-Feldes.
     */
    const PASSWORD = "password";

    /**
     * @var FileAccess $fileAccess Objekt zum Auslesen von Daten aus der BenutzerInnen-Datei.
     */
    private $fileAccess;

    /**
     * Legt ein neues Login-Objekt an und initialisiert das Objekt zum Datei-Lesen.
     */
    public function __construct() {
        parent::__construct();
        $this->fileAccess = new FileAccess();
    }

    /**
     * Übergibt die konkreten Inhalte an das Formularfeld. Dies sind einerseits die Bezeichnungen der Felder, die aus den
     * Konstanten stammen, als auch eventuell vorauszufüllende Werte, die über die Funktion {@link param()} eingesetzt werden.
     */
    protected function prepareFormFields() {
        $this->smarty->assign("usernameName", self::USERNAME);
        $this->smarty->assign("usernameValue", $this->param(self::USERNAME));
        $this->smarty->assign("passwordName", self::PASSWORD);
        $this->smarty->assign("passwordValue", $this->param(self::PASSWORD));
    }

    /**
     * Übernimmt die Ausgabe und Anzeige des Login-Formulars. Eventuell auftretende Fehlermeldungen werden an das
     * Template übergeben, in der Methode (@link prepareFormFields()) wird der Formularfeldinhalt vorbereitet und an
     * das Template übergeben. Das Template <pre>loginForm.tpl</pre> wird schließlich angezeigt.
     */
    protected function printForm() {
        $this->smarty->assign("errorMessages", $this->errMsg);
        $this->prepareFormFields();
        $this->smarty->display("loginForm.tpl");
    }

    /**
     * Authentifiziert einen/eine BenutzerIn anhand von Benutzername und Passwort.
     * @param string $username Der beim Login verwendete Benutzername.
     * @param string $password Das beim Login verwendete Passwort.
     * @return bool Gibt <pre>true</pre> zurück, wenn die Kombination vorhanden ist, ansonsten <pre>false</pre>.
     */
    protected function authenticate($username, $password) {
        $users = $this->fileAccess->getUsers();

        foreach ($users as $user) {
            if (strcmp($username, $user[0]) === 0 && password_verify($password, $user[1])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Überprüft, ob Benutzername und Passwort eingegeben wurden (Pflichtfelder) und ob die Kombination vorhanden bzw.
     * korrekt ist. Schlägt ein Kriterium fehl, erfolgt ein Eintrag in die Eigenschaft <pre>$errMsg</pre>.
     * @return bool Gibt <pre>true</pre> zurück, wenn alle Kriterien erfüllt wurden, ansonsten <pre>false</pre>.
     */
    protected function isValidForm() {
        if ($this->isEmpty(self::USERNAME)) {
            $this->errMsg[self::USERNAME] = "Bitte Benutzernamen eingeben.";
        }
        if ($this->isEmpty(self::PASSWORD)) {
            $this->errMsg[self::PASSWORD] = "Bitte Passwort eingeben.";
        }
        if (!$this->isEmpty(self::USERNAME) && !$this->isEmpty(self::PASSWORD) && !$this->authenticate($_POST[self::USERNAME], $_POST[self::PASSWORD])) {
            $this->errMsg[self::PASSWORD] = "Benutzername oder Passwort ist ungültig.";
        }
        return (count($this->errMsg) === 0);
    }

    /**
     * Wurden ein korrekter Benutzername und Passwort eingegeben, erfolgt eine Weiterleitung auf die Hauptseite.
     * Zuvor werden noch die IP-Adresse und Browser-Details in die Session gespeichert, um Session-Forgery vorzubeugen.
     * Ebenso wird der Benutzername in die Session gespeichert, um ihn später zur Verfügung zu haben.
     */
    protected function processForm() {
        $_SESSION[LOGIN] = sha1($_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"]);
        $_SESSION[USERNAME] = $_POST[self::USERNAME];

        header(FORWARD_INDEX);
    }
}

$form = new LoginForm();
$form->normForm();