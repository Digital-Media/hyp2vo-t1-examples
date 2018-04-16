<?php

namespace LoginExample;

use AbstractNormForm;
use View;

/**
 * The main page.
 *
 * Does nothing but showing simple content to prove that the login was successful.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2018
 */
final class Index extends AbstractNormForm
{
    /**
     * Creates a new Index object. We don't really need a class based on AbstractNormForm here since it doesn't do
     * anything besides displaying a template.
     * @param View $defaultView The default View object with information on what will be displayed.
     * @param string $templateDir The Smarty template directory.
     * @param string $compileDir The Smarty compiled template directory.
     */
    public function __construct(View $defaultView, $templateDir = "templates", $compileDir = "templates_c")
    {
        parent::__construct($defaultView, $templateDir, $compileDir);
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
    protected function business()
    {
        // Nothing is done here since no form is submitted.
    }
}
