<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

// Einfacher PSR-4 Autoloader von https://gist.github.com/Shelob9/acf3109c006f2957c12ea6b317f549f2
spl_autoload_register(function ($class) {
    //change this to your root namespace
    $prefix = "Twig";
    //make sure this is the directory with your classes
    $base_dir = __DIR__ . "/Twig/src/";
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace("\\", DIRECTORY_SEPARATOR, $relative_class) . ".php";
    if (file_exists($file)) {
        require $file;
    }
});

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader, ["cache" => "templates_c", "auto_reload" => true]);

try {
    $twig->display("message.html.twig", ["name" => "John Doe", "message" => "I'm back baby!"]);
} catch (LoaderError $e) {
    // LoaderError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (RuntimeError $e) {
    // RuntimeError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (SyntaxError $e) {
    // SyntaxError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
}
