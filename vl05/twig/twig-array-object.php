<?php

declare(strict_types=1);

namespace Fhooe\Mtd\Hypermedia\Vl05;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

require "vendor/autoload.php";

/**
 * A simple class representing a person by name, gender and age.
 */
class Person
{
    public string $name;
    public string $gender;
    public int $age;

    /**
     * Creates a new person.
     * @param string $name The person's name.
     * @param string $gender The person's gender.
     * @param int $age The person's age.
     */
    public function __construct(string $name, string $gender, int $age)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
    }
}

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader, ["cache" => "templates_c", "auto_reload" => true]);

$array = ["John Doe", "male", 25];
$assocArray = ["name" => "Jane Doe", "details" => ["gender" => "female", "age" => 23]];
$object = new Person("Jim Doe", "male", 3);

try {
    $twig->display("arrayexample.html.twig", ["data1" => $array, "data2" => $assocArray, "data3" => $object]);
} catch (LoaderError $e) {
    // LoaderError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (RuntimeError $e) {
    // RuntimeError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (SyntaxError $e) {
    // SyntaxError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
}
