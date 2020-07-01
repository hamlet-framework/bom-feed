<?php

namespace Hamlet\BureauOfMeteorology\Content\Temperature;

use PhpUnitConversion\Unit\Temperature;

class TemperatureConditions
{
    /**
     * @var Temperature|null
     */
    private $airTemperature;

    /**
     * @var Temperature
     */
    private $apparentTemperature;

    /**
     * @var Temperature|null
     */
    private $dewPoint;

    /**
     * @var Temperature|null
     */
    private $deltaT;

    /**
     * @param Temperature|null $airTemperature
     * @param Temperature $apparentTemperature
     * @param Temperature|null $dewPoint
     * @param Temperature|null $deltaT
     */
    public function __construct($airTemperature, Temperature $apparentTemperature, $dewPoint, $deltaT)
    {
        $this->airTemperature = $airTemperature;
        $this->apparentTemperature = $apparentTemperature;
        $this->dewPoint = $dewPoint;
        $this->deltaT = $deltaT;
    }

    /**
     * @return Temperature|null
     */
    public function air()
    {
        return $this->airTemperature;
    }

    /**
     * @return Temperature|null
     */
    public function apparent()
    {
        return $this->apparentTemperature;
    }

    /**
     * @return Temperature
     */
    public function dewPoint()
    {
        return $this->dewPoint;
    }

    /**
     * @return Temperature|null
     */
    public function deltaT()
    {
        return $this->deltaT;
    }
}
