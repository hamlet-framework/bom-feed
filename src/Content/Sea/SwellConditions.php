<?php

namespace Hamlet\BureauOfMeteorology\Content\Sea;

use Hamlet\BureauOfMeteorology\Content\Direction;
use PhpUnitConversion\Unit\Length;
use PhpUnitConversion\Unit\Time;

class SwellConditions
{
    /**
     * @var Direction|null
     */
    private $swellDirection;

    /**
     * @var Length|null
     */
    private $swellHeight;

    /**
     * @var Time|null
     */
    private $swellPeriod;

    /**
     * @param Direction|null $swellDirection
     * @param Length|null $swellHeight
     * @param Time|null $swellPeriod
     */
    public function __construct($swellDirection, $swellHeight, $swellPeriod)
    {
        $this->swellDirection = $swellDirection;
        $this->swellHeight = $swellHeight;
        $this->swellPeriod = $swellPeriod;
    }

    /**
     * @return Direction|null
     */
    public function direction()
    {
        return $this->swellDirection;
    }

    /**
     * @return Length|null
     */
    public function height()
    {
        return $this->swellHeight;
    }

    /**
     * @return Time|null
     */
    public function period()
    {
        return $this->swellPeriod;
    }
}
