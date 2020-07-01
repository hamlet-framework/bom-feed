<?php

namespace Hamlet\BureauOfMeteorology\Content\Sea\State;

use PhpUnitConversion\Unit\Length\Meter;

/**
 * @see http://www.bom.gov.au/marine/knowledge-centre/reference/waves.shtml
 */
abstract class SeaState
{
    /**
     * @var SeaStateDescription
     */
    protected $description;

    protected function __construct(SeaStateDescription $description)
    {
        $this->description = $description;
    }

    public static function of(string $waveLengthSpecification)
    {
        if ($waveLengthSpecification == 'Calm') {
            return new PointValueSeaState(SeaStateDescription::CALM_GLASSY(), new Meter(0));
        } elseif ($waveLengthSpecification == '&lt;0.1') {
            return new IntervalSeaState(SeaStateDescription::CALM_RIPPLED(), '< 0.1');
        } elseif ($waveLengthSpecification == '&lt;0.5') {
            return new IntervalSeaState(SeaStateDescription::SMOOTH(), '< 0.5');
        }
        $waveLength = new Meter((float) $waveLengthSpecification);
        if ($waveLength < 1.25) {
            return new PointValueSeaState(SeaStateDescription::SLIGHT(), $waveLength);
        } elseif ($waveLength < 2.5) {
            return new PointValueSeaState(SeaStateDescription::MODERATE(), $waveLength);
        } elseif ($waveLength < 4) {
            return new PointValueSeaState(SeaStateDescription::ROUGH(), $waveLength);
        } elseif ($waveLength < 6) {
            return new PointValueSeaState(SeaStateDescription::VERY_ROUGH(), $waveLength);
        } elseif ($waveLength < 9) {
            return new PointValueSeaState(SeaStateDescription::HIGH(), $waveLength);
        } elseif ($waveLength < 14) {
            return new PointValueSeaState(SeaStateDescription::VERY_HIGH(), $waveLength);
        } else {
            return new PointValueSeaState(SeaStateDescription::PHENOMENAL(), $waveLength);
        }
    }

    public function description(): SeaStateDescription
    {
        return $this->description;
    }
}
