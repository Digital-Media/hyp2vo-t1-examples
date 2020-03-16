<?php

/**
 * Trait, der die Speicherung und Ausgabe von Positionsdaten (Breiten- und Längengrad) ermöglicht.
 */
trait LocatableTrait
{
    private float $latitude;
    private float $longitude;

    /**
     * Setzt ein Koordinatenpaar aus Breiten- und Längengrad.
     * @param array $pos Das Array mit Breiten (Pos. 0) und Längengrad (Pos. 1).
     */
    public function setPosition(array $pos): void
    {
        $this->latitude = $pos[0];
        $this->longitude = $pos[1];
    }

    /**
     * Setzt den Breitengrad.
     * @param float $lat Der Breitengrad.
     */
    public function setLatitude(float $lat): void
    {
        $this->latitude = $lat;
    }

    /**
     * Setzt den Längengrad.
     * @param float $lon Der Längengrad.
     */
    public function setLongitude(float $lon): void
    {
        $this->longitude = $lon;
    }

    /**
     * Gibt die gespeicherte Position als Koordinatenpaar zurück.
     * @return array Das Array mit Breiten (Pos. 0) und Längengrad (Pos. 1).
     */
    public function getPosition(): array
    {
        return [$this->latitude, $this->longitude];
    }

    /**
     * Gibt den Breitengrad zurück.
     * @return float Der Breitengrad.
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Gibt den Längengrad zurück.
     * @return float Der Längengrad
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
