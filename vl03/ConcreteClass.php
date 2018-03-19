<?php

require("AbstractClass.php");

class ConcreteClass extends AbstractClass
{
    protected function getValue()
    {
        return "ConcreteClass";
    }
}
