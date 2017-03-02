<?php

interface GeometricComponent {
    public function draw();

    public function move($dx, $dy);
}