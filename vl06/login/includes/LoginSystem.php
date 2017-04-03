<?php

/**
 * Enforces the protection of pages in the session based login system through redirects.
 *
 * In a site with a login system, this class is the main factor in protecting pages from unauthorized access. By placing
 * a static call to protectPage() before a concrete instance of an AbstractNormForm class is created (e.g. on the index
 * or login pages), a guardian is installed that checks for valid login credentials in the session and performs a
 * redirect to the according page if the criteria are not fulfilled. This class also offers a method for a general
 * redirect as well as a method for creating a hash that can be stored in the session as a login token.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2017
 */
class LoginSystem
{
    /**
     * Place this static method before the main call of an AbstractNormForm-based class to enable the login mechanism.
     * The global constants LOGIN and INDEX as well as PROTECTED_PAGES define the pages that are part of the
     * login mechanism. LOGIN is not shown (therefore redirected to INDEX) when a user is logged in.
     * All pages in the PROTECTED_PAGES array are redirected to LOGIN if no user is logged in.
     */
    public static function protectPage()
    {
        $currentPage = basename($_SERVER["SCRIPT_NAME"]);
        $redirect = null;

        switch ($currentPage) {
            case LOGIN:
                if (isset($_SESSION[IS_LOGGED_IN]) && $_SESSION[IS_LOGGED_IN] === self::generateLoginHash()) {
                    $redirect = INDEX;
                }
                break;
            case in_array($currentPage, PROTECTED_PAGES):
                if (!isset($_SESSION[IS_LOGGED_IN]) || $_SESSION[IS_LOGGED_IN] !== self::generateLoginHash()) {
                    $redirect = LOGIN;
                }
                break;
            default:
                $redirect = null;
        }
        if ($redirect) {
            self::redirectTo($redirect);
        }
    }

    /**
     * Performs a generic redirect using header().
     * @param string $location The target location for the redirect.
     */
    public static function redirectTo(string $location)
    {
        header("Location: $location");
        exit();
    }

    /**
     * Generates a 512 bit hash value using the SHA-512 algorithm. The user's IP address as well as the user agent
     * string are hashed. This hash can then be stored in the §_SESSION array to act as a token for a logged in user.
     * @return string The login hash value.
     */
    public static function generateLoginHash(): string
    {
        return hash("sha512", $_SERVER["REMOTE_ADDR"] . $_SERVER["HTTP_USER_AGENT"]);
    }
}
