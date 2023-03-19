<?php

/**
 * Trait with methods to store and output position data (latitude and longitude).
 */
trait LocatableTrait
{
    private float $latitude;
    private float $longitude;

    /**
     * Sets a coordinate pair from latitude and longitude.
     * @param array $pos The array with latitude (Pos. 0) and longitude (Pos. 1).
     * @return void Returns nothing.
     */
    public function setPosition(array $pos): void
    {
        $this->latitude = $pos[0];
        $this->longitude = $pos[1];
    }

    /**
     * Sets the latitude.
     * @param float $lat The latitude.
     * @return void Returns nothing.
     */
    public function setLatitude(float $lat): void
    {
        $this->latitude = $lat;
    }

    /**
     * Sets the longitude.
     * @param float $lon The longitude.
     * @return void Returns nothing.
     */
    public function setLongitude(float $lon): void
    {
        $this->longitude = $lon;
    }

    /**
     * Returns the stored position as a coordinate pair.
     * @return array The array with latitude (Pos. 0) and longitude (Pos. 1).
     */
    public function getPosition(): array
    {
        return [$this->latitude, $this->longitude];
    }

    /**
     * Returns the latitude.
     * @return float The latitude.
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns the longitude.
     * @return float The longitude.
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
