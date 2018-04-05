<?php

final class NoInheritance
{
    public function foo()
    {
        // ...
    }
}

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

class InheritParts extends CantOverrideEverything
{
    public function canOverride()
    {
        // ...
    }
}
