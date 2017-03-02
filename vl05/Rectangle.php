<?php

require("GeometricComponent.php");

class Rectangle implements GeometricComponent {
    public $x1;
    public $y1;
    public $x2;
    public $y2;
    public $color;
    public static $version = "1.0";
    const TYPE = "Rectangle";

    public function __construct($x1 = 0, $y1 = 0, $x2 = 0, $y2 = 0, $color = 0) {
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
        $this->color = $color;
    }

    public function __destruct() {
        echo "Destructor called!";
    }

    public function move($dx, $dy) {
        $this->x1 += $dx;
        $this->y1 += $dy;
        $this->x2 += $dx;
        $this->y2 += $dy;
    }

    public function getX1() {
        return $this->x1;
    }

    public function getVersion() {
        return self::$version;
    }

    public function getType() {
        return self::TYPE;
    }

    public function draw() {
        //...
    }
}

$green = 5;

$rect1 = new Rectangle();
$rect2 = new Rectangle(45, 60, 110, 112, $green);
$rect1->move(10, 10);

echo Rectangle::$version; // 1.0
echo $rect1->getVersion(); // 1.0
//echo $rect1->version; // FEHLER!

echo Rectangle::TYPE; // Rectangle
echo $rect1->getType(); // Rectangle
//echo $rect1->TYPE; // FEHLER!