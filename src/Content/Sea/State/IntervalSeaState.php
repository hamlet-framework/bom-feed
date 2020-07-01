<?php

namespace Hamlet\BureauOfMeteorology\Content\Sea\State;

class IntervalSeaState extends SeaState
{
    /**
     * @var string
     */
    private $interval;

    public function __construct(SeaStateDescription $description, string $interval)
    {
        parent::__construct($description);
        $this->interval = $interval;
    }

    public function interval(): string
    {
        return $this->interval;
    }
}
