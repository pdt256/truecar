<?php
namespace pdt256\truecar\Entity;

class MPGReport
{
    /** @var int */
    private $minimum;

    /** @var int */
    private $maximum;

    /** @var double */
    private $average;

    /** @var int */
    private $vehicleCount;

    /** @var Make */
    private $make;

    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @param int $minimum
     */
    public function setMinimum($minimum)
    {
        $this->minimum = (int) $minimum;
    }

    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * @param int $maximum
     */
    public function setMaximum($maximum)
    {
        $this->maximum = (int) $maximum;
    }

    public function getAverage()
    {
        return $this->average;
    }

    /**
     * @param double $average
     */
    public function setAverage($average)
    {
        $this->average = (double) $average;
    }

    public function getVehicleCount()
    {
        return $this->vehicleCount;
    }

    /**
     * @param int $vehicleCount
     */
    public function setVehicleCount($vehicleCount)
    {
        $this->vehicleCount = (int) $vehicleCount;
    }

    public function getMake()
    {
        return $this->make;
    }

    public function setMake(Make $make)
    {
        $this->make = $make;
    }
}
