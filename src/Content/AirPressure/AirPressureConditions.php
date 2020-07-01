<?php

namespace Hamlet\BureauOfMeteorology\Content\AirPressure;

use PhpUnitConversion\Unit\Length;

class AirPressureConditions
{
    /**
     * @var AirPressureTendency|null
     */
    private $tendency;

    /**
     * @param AirPressureTendency|null $tendency
     */
    public function __construct($tendency)
    {
        $this->tendency = $tendency;
    }

    public function tendency(): AirPressureTendency
    {
        return $this->tendency;
    }
}
