<?php

trait LocatableTrait
{
    private $latitude;
    private $longitude;

    public function setPosition(array $pos)
    {
        $this->latitude = $pos[0];
        $this->longitude = $pos[1];
    }

    public function setLatitude(float $lat)
    {
        $this->latitude = $lat;
    }

    public function setLongitude(float $lon)
    {
        $this->longitude = $lon;
    }

    public function getPosition(): array
    {
        return [$this->latitude, $this->longitude];
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}