<?php

namespace LoginExample;

use Fhooe\Router\Router;

/**
 * RouteGuard is a simple, session-based mechanism to protect certain routes. It can either check if a session token is
 * present and valid and if not, perform a redirect or check, if a session token is explicitly not present.
 * @package LoginExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2022
 */
class RouteGuard
{
    /**
     * The trait Utilities can now be used as part of the class RouteGuards.
     * For Example: self::sanitizeFilter($string).
     */
    use Utilities;

    /**
     * Requires that a session token is present and valid in order to access the route. If this is not the case,
     * a redirect is performed to the route provided in $exitRoute.
     * @param string $exitRoute The route to redirect if the session token is not present or invalid.
     * @return void Returns nothing.
     */
    public static function requireLoggedIn(string $exitRoute): void
    {
        if (!isset($_SESSION["isloggedin"]) || $_SESSION["isloggedin"] !== self::generateLoginHash()) {
            Router::redirectTo($exitRoute);
        }
    }

    /**
     * Requires that a session token is not present or invalid in order to access the route. If this is not the case,
     * a redirect is performed to the route provided in $exitRoute.
     * @param string $exitRoute The route to redirect if the session token is present valid.
     * @return void Returns nothing.
     */
    public static function requireNotLoggedIn(string $exitRoute): void
    {
        if (isset($_SESSION["isloggedin"]) && $_SESSION["isloggedin"] === self::generateLoginHash()) {
            Router::redirectTo($exitRoute);
        }
    }
}
