<?php

namespace Hamlet\BureauOfMeteorology\Content\Wind;

use Hamlet\BureauOfMeteorology\Content\Direction;
use PhpUnitConversion\Unit\Velocity;

class WindConditions
{
    /**
     * @var Direction|null
     */
    private $direction;

    /**
     * @var Velocity|null
     */
    private $speed;

    /**
     * @var Velocity|null
     */
    private $gust;

    /**
     * @param Direction|null $direction
     * @param Velocity|null $speed
     * @param Velocity|null $gust
     */
    public function __construct($direction, $speed, $gust)
    {
        $this->direction = $direction;
        $this->speed = $speed;
        $this->gust = $gust;
    }

    /**
     * @return Direction|null
     */
    public function direction()
    {
        return $this->direction;
    }

    /**
     * @return Velocity|null
     */
    public function speed()
    {
        return $this->speed;
    }

    /**
     * @return Velocity|null
     */
    public function gust()
    {
        return $this->gust;
    }
}
