<?php

namespace Hamlet\BureauOfMeteorology\Content;

use DateTimeZone;

class Observations
{
    /**
     * @var string
     */
    private $stationName;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var State
     */
    private $state;

    /**
     * @var DateTimeZone
     */
    private $timeZone;

    /**
     * @var Entry[]
     */
    private $entries;

    /**
     * @param string $stationName
     * @param Location $location
     * @param State $state
     * @param DateTimeZone $timeZone
     * @param Entry[] $entries
     */
    public function __construct(string $stationName, Location $location, State $state, DateTimeZone $timeZone, array $entries)
    {
        $this->stationName = $stationName;
        $this->location = $location;
        $this->state = $state;
        $this->timeZone = $timeZone;
        $this->entries = $entries;
    }

    public function stationName(): string
    {
        return $this->stationName;
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function state(): State
    {
        return $this->state;
    }

    public function timeZone(): DateTimeZone
    {
        return $this->timeZone;
    }

    /**
     * @return Entry[]
     */
    public function entries(): array
    {
        return $this->entries;
    }
}
