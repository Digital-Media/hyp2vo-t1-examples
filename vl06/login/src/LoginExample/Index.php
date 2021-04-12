<?php

namespace LoginExample;

use Fhooe\NormForm\Core\AbstractNormForm;
use Fhooe\NormForm\View\View;

/**
 * The main page.
 *
 * It does nothing but showing simple content to prove that the login was successful.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2021
 */
final class Index extends AbstractNormForm
{
    /**
     * Creates a new Index object. We don't actually need a class based on AbstractNormForm here since it doesn't do
     * anything besides displaying a template.
     * @param View $defaultView Holds the initial @View object used for displaying the form.
     */
    public function __construct(View $defaultView)
    {
        parent::__construct($defaultView);
    }

    /**
     * Validates user input but here's nothing to validate so we just return true.
     * @return bool Returns true if no errors occurred and therefore no error messages were set, otherwise false.
     */
    protected function isValid(): bool
    {
        // Nothing is validated here since we don't have a form.
        return true;
    }

    /**
     * This method is only called when the form input was validated successfully. Since we don't have a form it's empty.
     */
    protected function business(): void
    {
        // Nothing is done here since no form is submitted.
    }
}
