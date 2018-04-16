<?php

namespace LoginExample;

use AbstractNormForm;
use GenericParameter;
use View;


/**
 * The login page.
 *
 * This class enables users to log in to the system with a provided user name and password. Both items are match with
 * stored credentials. If they match, a login hash is stored in the session that acts as a token for a successful login.
 * Other pages can then use check for this token before the site is initialized and perform a redirect to prevent
 * accessing the page
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2018
 */
final class Login extends AbstractNormForm
{
    // trait Utilities can now be used as part of class Login.
    // For Example: $this->sanitizeFilter($string) instead of Utilities::sanitizeFilter($string)
    use Utilities;

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
     * @var string USER_DATA_PATH The full path for the user meta data JSON file.
     */
    const USER_DATA_PATH = DATA_DIRECTORY . "userdata.json";

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
            !$this->isEmptyPostField(self::PASSWORD) &&
            !$this->authenticateUser()) {
            $this->errorMessages[self::PASSWORD] = "Invalid user name or password.";
        }

        $this->currentView->setParameter(new GenericParameter("errorMessages", $this->errorMessages));

        return (count($this->errorMessages) === 0);
    }

    /**
     * This method is only called when the form input was validated successfully.
     * It stores the username in the session for further use (e.g. in the template).
     * It then forwards to the register page.
     */
    protected function business()
    {
        $_SESSION[self::USERNAME] = $_POST[self::USERNAME];

        $_SESSION[IS_LOGGED_IN] = $this->generateLoginHash();

        View::redirectTo("index.php");
    }

    /**
     * Authenticates a user by matching the entered username and password with the stored records. If the username is
     * present and the entered password matches the stored password, a valid login is assumed and stored in $_SESSION
     *
     * @return bool Returns true if the combination of username and password is valid, otherwise false.
     */
    private function authenticateUser(): bool
    {
        $users = $this->fileAccess->loadContents(self::USER_DATA_PATH);

        foreach ($users as $user) {
            if ($user[self::USERNAME] === $_POST[self::USERNAME] &&
                password_verify($_POST[self::PASSWORD], $user[self::PASSWORD])) {
                return true;
            }
        }
        return false;
    }
}
