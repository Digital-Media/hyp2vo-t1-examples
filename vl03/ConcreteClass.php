<?php

require("AbstractClass.php");

/**
 * Konkrete Implementierung der abstrakten Basisklasse. Die "fehlende", abstrakte Methode wird hier implementiert.
 */
class ConcreteClass extends AbstractClass
{
    protected function getValue(): string
    {
        return "ConcreteClass";
    }
}
