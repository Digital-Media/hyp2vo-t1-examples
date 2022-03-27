<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader("templates");
$twig = new Environment($loader, ["cache" => "templates_c", "auto_reload" => true]);

$array = ["Red", "Green", "Blue"];

try {
    $twig->display("for.html.twig", ["colors" => $array]);
} catch (LoaderError $e) {
    // LoaderError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (RuntimeError $e) {
    // RuntimeError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
} catch (SyntaxError $e) {
    // SyntaxError Exception behandeln (z.B. auf eine Fehlerseite weiterleiten).
}
