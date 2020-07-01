<?php

namespace Hamlet\BureauOfMeteorology\Content\Precipitation;

use PhpUnitConversion\Unit\Length;

class PrecipitationConditions
{
    /**
     * @var Length|null
     */
    private $precipitation;

    /**
     * @var int|null
     */
    private $relativeHumidity;

    /**
     * @param Length|null $precipitation
     * @param int|null $relativeHumidity
     */
    public function __construct($precipitation, $relativeHumidity)
    {
        $this->precipitation = $precipitation;
        $this->relativeHumidity = $relativeHumidity;
    }

    /**
     * @return Length|null
     */
    public function precipitation()
    {
        return $this->precipitation;
    }

    /**
     * @return int|null
     */
    public function relativeHumidity()
    {
        return $this->relativeHumidity;
    }
}
