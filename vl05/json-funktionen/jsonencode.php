<?php

/**
 * Simple class to demonstrate JSON functionalities.
 */
class Person
{
    public string $name;
    public int $age;
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

$array = ["Good", "Bad", "Ugly"];

$assocArray = ["key" => "value", "otherkey" => "othervalue"];

$simpleNumber = 42;

$jsonObject = json_encode(new Person("John Doe", 34, "Doeland"), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$jsonArray = json_encode($array, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$jsonAssocArray = json_encode($assocArray, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
$jsonInteger = json_encode($simpleNumber, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

file_put_contents("object.json", $jsonObject);
file_put_contents("array.json", $jsonArray);
file_put_contents("assocarray.json", $jsonAssocArray);
file_put_contents("integer.json", $jsonInteger);

echo json_last_error_msg();
