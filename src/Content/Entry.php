<?php

namespace Hamlet\BureauOfMeteorology\Content;

use DateTimeImmutable;
use Hamlet\BureauOfMeteorology\Content\AirPressure\AirPressureConditions;
use Hamlet\BureauOfMeteorology\Content\Clouds\CloudConditions;
use Hamlet\BureauOfMeteorology\Content\Precipitation\PrecipitationConditions;
use Hamlet\BureauOfMeteorology\Content\Sea\SeaConditions;
use Hamlet\BureauOfMeteorology\Content\Temperature\TemperatureConditions;
use Hamlet\BureauOfMeteorology\Content\Wind\WindConditions;
use PhpUnitConversion\Unit\Length;

class Entry
{
    /**
     * @var DateTimeImmutable
     */
    private $time;

    /**
     * @var WeatherSummary|null
     */
    private $weatherSummary;

    /**
     * @var Length|null
     */
    private $visibility;

    /**
     * @var TemperatureConditions
     */
    private $temperatureConditions;

    /**
     * @var PrecipitationConditions
     */
    private $precipitationConditions;

    /**
     * @var AirPressureConditions
     */
    private $airPressureConditions;

    /**
     * @var WindConditions
     */
    private $windConditions;

    /**
     * @var SeaConditions
     */
    private $seaConditions;

    /**
     * @var CloudConditions
     */
    private $cloudConditions;

    /**
     * @param DateTimeImmutable $time
     * @param WeatherSummary|null $weatherSummary
     * @param Length|null $visibility
     * @param TemperatureConditions $temperatureConditions
     * @param PrecipitationConditions $precipitationConditions
     * @param AirPressureConditions $airPressureConditions
     * @param WindConditions $windConditions
     * @param SeaConditions $seaConditions
     * @param CloudConditions $cloudConditions
     */
    public function __construct(
        DateTimeImmutable $time,
        $weatherSummary,
        $visibility,
        TemperatureConditions $temperatureConditions,
        PrecipitationConditions $precipitationConditions,
        AirPressureConditions $airPressureConditions,
        WindConditions $windConditions,
        SeaConditions $seaConditions,
        CloudConditions $cloudConditions)
    {
        $this->time = $time;
        $this->weatherSummary = $weatherSummary;
        $this->visibility = $visibility;
        $this->temperatureConditions = $temperatureConditions;
        $this->precipitationConditions = $precipitationConditions;
        $this->airPressureConditions = $airPressureConditions;
        $this->windConditions = $windConditions;
        $this->seaConditions = $seaConditions;
        $this->cloudConditions = $cloudConditions;
    }

    public function time(): DateTimeImmutable
    {
        return $this->time;
    }

    /**
     * @return WeatherSummary|null
     */
    public function summary()
    {
        return $this->weatherSummary;
    }

    /**
     * @return Length|null
     */
    public function visibility()
    {
        return $this->visibility;
    }

    public function temperature(): TemperatureConditions
    {
        return $this->temperatureConditions;
    }

    public function precipitation(): PrecipitationConditions
    {
        return $this->precipitationConditions;
    }

    public function airPressure(): AirPressureConditions
    {
        return $this->airPressureConditions;
    }

    public function wind(): WindConditions
    {
        return $this->windConditions;
    }

    public function sea(): SeaConditions
    {
        return $this->seaConditions;
    }

    public function clouds(): CloudConditions
    {
        return $this->cloudConditions;
    }
}
