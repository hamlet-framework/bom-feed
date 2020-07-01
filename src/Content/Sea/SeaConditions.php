<?php

namespace Hamlet\BureauOfMeteorology\Content\Sea;

use Hamlet\BureauOfMeteorology\Content\Sea\State\SeaState;

class SeaConditions
{
    /**
     * @var SeaState|null
     */
    private $seaState;

    /**
     * @var SwellConditions
     */
    private $swellConditions;

    /**
     * @param SeaState|null $seaState
     * @param SwellConditions $swellConditions
     */
    public function __construct($seaState, SwellConditions $swellConditions)
    {
        $this->seaState = $seaState;
        $this->swellConditions = $swellConditions;
    }

    /**
     * @return SeaState|null
     */
    public function state()
    {
        return $this->seaState;
    }

    public function swell(): SwellConditions
    {
        return $this->swellConditions;
    }
}
