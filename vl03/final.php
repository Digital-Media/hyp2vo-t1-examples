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
 * Klasse mit finaler Methode und Konstante. Diese Methode und diese Konstante können nicht in einer abgeleiteten Klasse
 * überschrieben werden.
 */
class CantOverrideEverything
{
    public const CAN_OVERRIDE = 1;
    final public const CANNOT_OVERRIDE = 2;

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
 * Diese Klasse erbt von CantOverrideEverything und kann aber nur canOverride() und die Konstante CAN_OVERRIDE
 * überschreiben.
 */
class InheritParts extends CantOverrideEverything
{
    public const CAN_OVERRIDE = 3;

    public function canOverride()
    {
        // ...
    }
}
