<?php

namespace Hamlet\BureauOfMeteorology\Feed;

use DateTimeImmutable;
use DateTimeZone;
use Hamlet\BureauOfMeteorology\Content\AirPressure\AirPressureConditions;
use Hamlet\BureauOfMeteorology\Content\AirPressure\AirPressureTendency;
use Hamlet\BureauOfMeteorology\Content\Clouds\CloudConditions;
use Hamlet\BureauOfMeteorology\Content\Clouds\CloudConditionSummary;
use Hamlet\BureauOfMeteorology\Content\Clouds\CloudType;
use Hamlet\BureauOfMeteorology\Content\Entry;
use Hamlet\BureauOfMeteorology\Content\Location;
use Hamlet\BureauOfMeteorology\Content\Observations;
use Hamlet\BureauOfMeteorology\Content\Precipitation\PrecipitationConditions;
use Hamlet\BureauOfMeteorology\Content\Sea\SeaConditions;
use Hamlet\BureauOfMeteorology\Content\Sea\State\SeaState;
use Hamlet\BureauOfMeteorology\Content\Sea\SwellConditions;
use Hamlet\BureauOfMeteorology\Content\State;
use Hamlet\BureauOfMeteorology\Content\Temperature\TemperatureConditions;
use Hamlet\BureauOfMeteorology\Content\WeatherSummary;
use Hamlet\BureauOfMeteorology\Content\Wind\WindConditions;
use Hamlet\BureauOfMeteorology\Content\Direction;
use PhpUnitConversion\Unit\Length\KiloMeter;
use PhpUnitConversion\Unit\Length\Meter;
use PhpUnitConversion\Unit\Length\MilliMeter;
use PhpUnitConversion\Unit\Temperature\Celsius;
use PhpUnitConversion\Unit\Time\Second;
use PhpUnitConversion\Unit\Velocity\KiloMeterPerHour;
use PhpUnitConversion\Unit\Velocity\Knot;

class FeedEnvelope
{
    /**
     * @var FeedObservations
     */
    public $observations;

    public function content(): Observations
    {
        $stationName = $this->observations->header[0]->name;

        $state = State::of($this->observations->header[0]->state);

        $timeZoneId = $this->observations->header[0]->time_zone;
        if (in_array($timeZoneId, ['CST', 'EST', 'WST'])) {
            $timeZoneId = 'A' . $timeZoneId;
        }
        $timeZone = new DateTimeZone($timeZoneId);

        $records = $this->observations->data;
        usort($records, function (FeedData $a, FeedData $b): int {
            return $a->sort_order <=> $b->sort_order;
        });

        $location = new Location($records[0]->lat, $records[0]->lon);

        $entries = [];
        foreach ($records as $record) {
            $time = DateTimeImmutable::createFromFormat('YmdHis', $record->local_date_time_full, $timeZone);

            $weatherSummary = $record->weather == '-' ? null : WeatherSummary::of($record->weather);

            $visibility = $record->vis_km == '-' ? null : new KiloMeter((float) $record->vis_km);

            $cloudConditionSummary = $record->cloud == '-' ? null : CloudConditionSummary::of($record->cloud);
            $cloudBase             = $record->cloud_base_m === null ? null : new Meter($record->cloud_base_m);
            $cloudOktas            = $record->cloud_oktas;
            $cloudType             = $record->cloud_type == '-' ? null : CloudType::of($record->cloud_type);
            $cloudTypeId           = $record->cloud_type_id;
            $cloudConditions       = new CloudConditions($cloudConditionSummary, $cloudBase, $cloudOktas, $cloudType, $cloudTypeId);

            $airTemperature        = $record->air_temp === null ? null : new Celsius($record->air_temp);
            $apparentTemperature   = new Celsius($record->apparent_t);
            $dewPoint              = $record->dewpt === null ? null : new Celsius($record->dewpt);
            $deltaT                = $record->delta_t === null ? null : new Celsius($record->delta_t);
            $temperatureConditions = new TemperatureConditions($airTemperature, $apparentTemperature, $dewPoint, $deltaT);

            $windDirection = $record->wind_dir == '-' ? null : Direction::of($record->wind_dir);
            if ($record->wind_spd_kmh !== null) {
                $windSpeed = new KiloMeterPerHour($record->wind_spd_kmh);
            } elseif ($record->wind_spd_kt !== null) {
                $windSpeed = (new Knot($record->wind_spd_kt))->to(KiloMeterPerHour::class);
            } else {
                $windSpeed = null;
            }
            if ($record->gust_kmh !== null) {
                $windGust = new KiloMeterPerHour($record->gust_kmh);
            } elseif ($record->gust_kt !== null) {
                $windGust = (new Knot($record->gust_kt))->to(KiloMeterPerHour::class);
            } else {
                $windGust = null;
            }
            $windConditions = new WindConditions($windDirection, $windSpeed, $windGust);

            $seaState        = $record->sea_state == '-' ? null : SeaState::of($record->sea_state);
            $swellDirection  = $record->swell_dir_worded == '-' ? null : Direction::of($record->swell_dir_worded);
            $swellHeight     = $record->swell_height === null ? null : new Meter($record->swell_height);
            $swellPeriod     = $record->swell_period === null ? null : new Second($record->swell_period);
            $swellConditions = new SwellConditions($swellDirection, $swellHeight, $swellPeriod);
            $seaConditions   = new SeaConditions($seaState, $swellConditions);

            $airPressureTendency   = $record->press_tend == '-' ? null : AirPressureTendency::of($record->press_tend);
            $airPressureConditions = new AirPressureConditions($airPressureTendency);

            $precipitation           = $record->rain_trace == '-' ? null : new MilliMeter((float) $record->rain_trace);
            $relativeHumidity        = $record->rel_hum;
            $precipitationConditions = new PrecipitationConditions($precipitation, $relativeHumidity);

            $entries[] = new Entry(
                $time,
                $weatherSummary,
                $visibility,
                $temperatureConditions,
                $precipitationConditions,
                $airPressureConditions,
                $windConditions,
                $seaConditions,
                $cloudConditions
            );
        }

        // @todo a lot of formatting here
        return new Observations($stationName, $location, $state, $timeZone, $entries);
    }
}
