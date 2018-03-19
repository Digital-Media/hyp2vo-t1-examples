<?php

require("Rectangle.php");

class Box extends Rectangle
{
    public $depth;

    public function draw()
    {
        // Vorderseite zeichnen (Rechteck)
        parent::draw();
        // Andere Seiten zeichen
        // ...
    }
}
