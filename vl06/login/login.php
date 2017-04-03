<?php
session_start();

require_once("includes/defines.inc.php");

require_once HTTPS_REDIRECT;
require_once NORM_FORM;
require_once LOGIN_SYSTEM;
require_once FILE_ACCESS;

/**
 * The login page of the IMAR image archive.
 *
 * This class enables users to log in to the system with a provided user name and password. Both items are match with
 * stored credentials. If they match, a login hash is stored in the session that acts as a token for a successful login.
 * Other pages can then use LoginSystem::protectPage() to check for this token before the site is initialized. If no
 * hash is present the login system redirects and prevents accessing the page.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */
final class Login extends AbstractNormForm
{
    /**
     * @var string USERNAME Form field constant that defines how the form field for holding the username is called
     * (id/name).
     */
    const USERNAME = "username";

    /**
     * @var string PASSWORD Form field constant that defines how the form field for holding the password is called
     * (id/name).
     */
    const PASSWORD = "password";

    /**
     * @var FileAccess $fileAccess The object handling all file access operations.
     */
    private $fileAccess;

    /**
     * Creates a new Login object based on AbstractNormForm. Takes a View object that holds the information about which
     * template will be shown and which parameters (e.g. for form fields) are passed on to the template.
     * The constructor needs initialize the object for file handling.
     * @param View $defaultView The default View object with information on what will be displayed.
     * @param string $templateDir The Smarty template directory.
     * @param string $compileDir The Smarty compiled template directory.
     */
    public function __construct(View $defaultView, $templateDir = "templates", $compileDir = "templates_c")
    {
        parent::__construct($defaultView, $templateDir, $compileDir);

        $this->fileAccess = new FileAccess();
    }

    /**
     * Validates user input after submitting login credentials. The function first has to check if both fields were
     * filled out and then checks the result of authenticateUser() to see if the credentials match others that are
     * already stored in the system.
     * @return bool Returns true if no errors occurred and therefore no error messages were set, otherwise false.
     */
    protected function isValid(): bool
    {
        if ($this->isEmptyPostField(self::USERNAME)) {
            $this->errorMessages[self::USERNAME] = "Please enter your user name.";
        }
        if ($this->isEmptyPostField(self::PASSWORD)) {
            $this->errorMessages[self::PASSWORD] = "Please enter your password.";
        }
        if (!$this->isEmptyPostField(self::USERNAME) &&
            !$this->isEmptyPostField(self::PASSWORD) && !$this->authenticateUser()
        ) {
            $this->errorMessages[self::PASSWORD] = "Invalid user name or password.";
        }

        $this->currentView->setParameter(new GenericParameter("errorMessages", $this->errorMessages));

        return (count($this->errorMessages) === 0);
    }

    /**
     * This method is only called when the form input was validated successfully. It generates a login hash and adds it
     * to session and also stores the username in the session for further use (e.g. in the template). It then forwards
     * to the INDEX page.
     */
    protected function business()
    {
        $_SESSION[IS_LOGGED_IN] = LoginSystem::generateLoginHash();
        $_SESSION[self::USERNAME] = $_POST[self::USERNAME];

        LoginSystem::redirectTo(INDEX);
    }

    /**
     * Authenticates a user by matching the entered username and password with the stored records. If the username is
     * present and the entered password matches the stored password, a valid login is assumed.
     * @return bool Returns true if the combination of username and password is valid, otherwise false.
     */
    private function authenticateUser(): bool
    {
        $users = $this->fileAccess->loadContents(FileAccess::USER_DATA_PATH);

        foreach ($users as $user) {
            if ($user[self::USERNAME] === $_POST[self::USERNAME] &&
                password_verify($_POST[self::PASSWORD], $user[self::PASSWORD])
            ) {
                return true;
            }
        }
        return false;
    }
}

// --- This is the main call of the norm form process

// Use this method call to enable login protection for this page (redirects to INDEX when logged in)
LoginSystem::protectPage();

// Defines a new view that specifies the template and the parameters that are passed to the template
$view = new View(View::FORM, "loginMain.tpl", [
    new PostParameter(Login::USERNAME),
    new GenericParameter("passwordKey", Login::PASSWORD)
]);

// Creates a new Login object and triggers the NormForm process
$login = new Login($view);
$login->normForm();
