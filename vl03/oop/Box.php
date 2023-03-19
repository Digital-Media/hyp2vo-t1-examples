<?php

require("Rectangle.php");

/**
 * Implementation of a 3D box based on a 2D rectangle.
 */
class Box extends Rectangle
{
    public int $depth;

    /**
     * Draws this box.
     */
    public function draw(): void
    {
        // Vorderseite zeichnen (Rechteck)
        parent::draw();
        // Andere Seiten zeichen
        // ...
    }
}
