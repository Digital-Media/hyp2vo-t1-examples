<?php

/**
 * Finale Klasse. Von ihr kann nicht abgeleitet werden.
 */
final class NoInheritance
{
    public function foo()
    {
        // ...
    }
}

/**
 * Klasse mit finaler Methode. Diese Methode kann nicht in einer abgeleiteten Klasse überschrieben werden.
 */
class CantOverrideEverything
{
    public function canOverride()
    {
        // ...
    }

    final public function cantOverride()
    {
        // ...
    }
}

/**
 * Diese Klasse erbt von CantOverrideEverything und kann aber nur canOverride() überschreiben.
 */
class InheritParts extends CantOverrideEverything
{
    public function canOverride()
    {
        // ...
    }
}
