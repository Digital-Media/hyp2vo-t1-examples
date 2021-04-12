<?php

namespace LoginExample;

use Fhooe\NormForm\Core\AbstractNormForm;
use Fhooe\NormForm\Parameter\GenericParameter;
use Fhooe\NormForm\View\View;

/**
 * The login page.
 *
 * This class enables users to log in to the system with a provided user name and password. Both items are matched with
 * stored credentials. If they match, a login hash is stored in the session that acts as a token for a successful login.
 * Other pages can then use check for this token before the site is initialized and perform a redirect to prevent
 * accessing the page
 *
 * @package LoginExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2021
 */
final class Login extends AbstractNormForm
{
    /**
     * The trait Utilities can now be used as part of the class Login.
     * For Example: self::sanitizeFilter($string) instead of Utilities::sanitizeFilter($string)
     */
    use Utilities;

    /**
     * @var string USERNAME Form field constant that defines how the form field for holding the username is called
     * (id/name).
     */
    public const USERNAME = "username";

    /**
     * @var string PASSWORD Form field constant that defines how the form field for holding the password is called
     * (id/name).
     */
    public const PASSWORD = "password";

    /**
     * @var string USER_DATA_PATH The full path for the user meta data JSON file.
     */
    private const USER_DATA_PATH = DATA_DIRECTORY . "userdata.json";

    /**
     * @var FileAccess $fileAccess The object handling all file access operations.
     */
    private FileAccess $fileAccess;

    /**
     * Creates a new Login object based on AbstractNormForm. Takes a View object that holds the information about which
     * template will be shown and which parameters (e.g. for form fields) are passed on to the template.
     * The constructor needs to initialize the object for file handling.
     * @param View $defaultView Holds the initial @View object used for displaying the form.
     */
    public function __construct(View $defaultView)
    {
        parent::__construct($defaultView);

        $this->fileAccess = new FileAccess();
    }

    /**
     * Validates user input after submitting login credentials. The function first has to check if both fields were
     * filled out and then checks the result of authenticateUser() to see if the credentials match ones that are
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
     * It stores the username in the session for further use (e.g. in the template) and a hash value to identify a
     * successful login.
     * It then forwards to the index page.
     */
    protected function business(): void
    {
        $_SESSION[self::USERNAME] = $_POST[self::USERNAME];

        $_SESSION[IS_LOGGED_IN] = self::generateLoginHash();

        View::redirectTo("index.php");
    }

    /**
     * Authenticates a user by matching the entered username and password with the stored records. If the username is
     * present and the entered password matches the stored password, a valid login is assumed and stored in $_SESSION.
     * After a successful login, the current password encryption is checked and if necessary, a rehash is performed.
     * @return bool Returns true if the combination of username and password is valid, otherwise false.
     */
    private function authenticateUser(): bool
    {
        $users = $this->fileAccess->loadContents(self::USER_DATA_PATH);

        foreach ($users as &$user) {
            if ($user[self::USERNAME] === $_POST[self::USERNAME] &&
                password_verify($_POST[self::PASSWORD], $user[self::PASSWORD])) {
                if (password_needs_rehash($user[self::PASSWORD], PASSWORD_DEFAULT)) {
                    $user[self::PASSWORD] = password_hash($_POST[self::PASSWORD], PASSWORD_DEFAULT);
                    $this->fileAccess->storeContents(self::USER_DATA_PATH, $users);
                }
                return true;
            }
        }
        return false;
    }
}
