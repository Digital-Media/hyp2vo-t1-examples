<?php

/**
 * Abstrakte Basisklasse. Die Funktion printOut() ist implementiert, getValue() jedoch nicht. Eine Kindklasse muss dies
 * übernehmen.
 */
abstract class AbstractClass
{
    abstract protected function getValue(): string;

    public function printOut(): void
    {
        echo $this->getValue();
    }
}
