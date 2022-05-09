<?php

namespace Hypermedia2\Vl09;

/**
 * A simple person class to demonstrate JSON functionalities.
 */
class Person
{
    /**
     * @var string The person's name.
     */
    public string $name;

    /**
     * @var int The person's age.
     */
    public int $age;

    /**
     * @var string The person's country of residence.
     */
    public string $country;

    /**
     * Person constructor.
     * @param string $name The person's name.
     * @param int $age The person's age.
     * @param string $country The person's country of residence.
     */
    public function __construct(string $name, int $age, string $country)
    {
        $this->name = $name;
        $this->age = $age;
        $this->country = $country;
    }
}
