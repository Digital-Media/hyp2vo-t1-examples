<?php

abstract class AbstractClass
{
    abstract protected function getValue();

    public function printOut()
    {
        echo $this->getValue();
    }
}
