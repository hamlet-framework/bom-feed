<?php

namespace Hamlet\BureauOfMeteorology\Content\Sea\State;

use PhpUnitConversion\Unit\Length;

class PointValueSeaState extends SeaState
{
    /**
     * @var Length
     */
    private $waveLength;

    public function __construct(SeaStateDescription $description, Length $waveLength)
    {
        parent::__construct($description);
        $this->waveLength = $waveLength;
    }

    public function waveLength(): Length
    {
        return $this->waveLength;
    }
}
