<?php
// Autoloader für Twig-Klassen von https://gist.github.com/sarciszewski/b6cd3776fbd20acaf26b
spl_autoload_register(function ($class) {
    // project-specific namespace prefix
    $prefix = 'Twig';
    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/Twig/lib/Twig/';
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    // get the relative class name
    $relative_class = substr($class, $len);
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('_', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

class Person
{
    public $name;
    public $gender;
    public $age;

    public function __construct(string $name, string $gender, int $age)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
    }
}

$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader, ["cache" => "templates_c", "auto_reload" => true]);

$array = ["John Doe", "male", 25];
$assocArray = ["name" => "Jane Doe", "details" => ["gender" => "female", "age" => 23]];
$object = new Person("Jim Doe", "male", 3);

try {
    $twig->display("arrayexample.html.twig", ["data1" => $array, "data2" => $assocArray, "data3" => $object]);
} catch (Twig_Error_Loader $e) {
    // Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (Twig_Error_Runtime $e) {
    // Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (Twig_Error_Syntax $e) {
    // Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
}
