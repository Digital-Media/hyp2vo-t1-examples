<?php

use Fhooe\Mtd\Hypermedia\Exercise;

/**
 * Lädt eine Klasse automatisch anhang des angegebenen Namespace, wenn die Verzeichnisstruktur den Namespace abbildet.
 * @param $className Der Name der zu ladenden Klasse (inklusive Namespace).
 */
function autoload($className)
{
    $className = ltrim($className, "\\");
    $fileName = "";
    $namespace = "";
    if ($lastNsPos = strrpos($className, "\\")) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace("\\", DIRECTORY_SEPARATOR, $namespace)
            . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace("_", DIRECTORY_SEPARATOR, $className) . ".php";

    require $fileName;
}

spl_autoload_register("autoload");

$lecture = new \Fhooe\Mtd\Hypermedia\Lecture();
$exercise = new Exercise();
