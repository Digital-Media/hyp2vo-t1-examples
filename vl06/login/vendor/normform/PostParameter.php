<?php

require_once("ParameterInterface.php");

/**
 * A special parameter that represents an entry in the $_POST superglobal.
 *
 * This parameter is specified by the index in the $_POST superglobal. If a form field called "foo" (name attribute)
 * should be tracked then "foo" needs to be supplied as $postName parameter. The class will set this index as its
 * name and will automatically set its value by doing a lookup in $_POST. If there is an entry present at the
 * supplied index, it will be set as the value, otherwise an empty string will be used.
 * When the value of this parameter is query via getValue() it will perform the update again before returning the
 * value. If the parameter's value was empty at creation but the $_POST superglobal has been filled through a
 * form submission in the meantime, this class will consider it when returning the value.
 * To disable this mechanism and create a parameter with an always empty value (e.g. when you want an empty form
 * field in your view), set the optional second parameter $forceEmpty to true.
 *
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @author Rimbert Rudisch-Sommer <rimbert.rudisch-sommer@fh-hagenberg.at>
 * @version 2017
 */
class PostParameter implements ParameterInterface
{
    /** @var string $name The name of the parameter. Always a string. */
    private $name;

    /** @var mixed $value The value of the parameter. Can hold any data type. */
    private $value;

    /** @var bool $forceEmpty A switch for forcing an always empty parameter object. */
    private $forceEmpty;

    /**
     * Creates a new parameter for the form field/$_POST entry with the name specified in $postName.
     * @param string $postName The index value in the $_POST superglobal this parameter should encapsulate.
     * @param bool $forceEmpty Forces the parameter to be always empty when true, otherwise the contents of $_POST are
     * used.
     */
    public function __construct(string $postName, bool $forceEmpty = false)
    {
        $this->forceEmpty = $forceEmpty;
        $this->name = $postName;
        $this->updateValue();
    }

    /**
     * Private method for updating the parameter's value. Checks if there is an entry in the $_POST superglobal.
     * If present, the entry is sanitized to avoid cross-site-scripting and then set as a value. Otherwise an
     * empty string is set. If $forceEmpty is set to true the value is always set as an empty string.
     */
    private function updateValue()
    {
        if ($this->forceEmpty) {
            $this->value = "";
        } else {
            $this->value = isset($_POST[$this->name]) ? htmlspecialchars($_POST[$this->name],
                ENT_QUOTES | ENT_HTML5) : "";

        }
    }

    /**
     * Returns the parameter's name. Always a string.
     * @return string The name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Updates the parameters value and then returns it. Always a string since it's form field data.
     * @return string The value.
     */
    public function getValue(): string
    {
        $this->updateValue();
        return $this->value;
    }
}
