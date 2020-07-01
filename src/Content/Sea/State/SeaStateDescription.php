<?php

namespace Hamlet\BureauOfMeteorology\Content\Sea\State;

use Hamlet\BureauOfMeteorology\Content\Enum;

final class SeaStateDescription extends Enum
{
    public static function CALM_GLASSY(): self
    {
        return self::values()['Calm (glassy)'];
    }

    public static function CALM_RIPPLED(): self
    {
        return self::values()['Calm (rippled)'];
    }

    public static function SMOOTH(): self
    {
        return self::values()['Smooth'];
    }

    public static function SLIGHT(): self
    {
        return self::values()['Slight'];
    }

    public static function MODERATE(): self
    {
        return self::values()['Moderate'];
    }

    public static function ROUGH(): self
    {
        return self::values()['Rough'];
    }

    public static function VERY_ROUGH(): self
    {
        return self::values()['Very rough'];
    }

    public static function HIGH(): self
    {
        return self::values()['High'];
    }

    public static function VERY_HIGH(): self
    {
        return self::values()['Very high'];
    }

    public static function PHENOMENAL(): self
    {
        return self::values()['Phenomenal'];
    }

    protected static function options(): array
    {
        return [
            'Calm (glassy)',
            'Calm (rippled)',
            'Smooth',
            'Slight',
            'Moderate',
            'Rough',
            'Very rough',
            'High',
            'Very high',
            'Phenomenal'
        ];
    }

    public function explanation(): string
    {
        if ($this === self::CALM_GLASSY()) {
            return 'No waves breaking on beach';
        } elseif ($this === self::CALM_RIPPLED()) {
            return 'No waves breaking on beach';
        } elseif ($this === self::SMOOTH()) {
            return 'Slight waves breaking on beach';
        } elseif ($this === self::SLIGHT()) {
            return 'Waves rock buoys and small craft';
        } elseif ($this === self::MODERATE()) {
            return 'Sea becoming furrowed';
        } elseif ($this === self::ROUGH()) {
            return 'Sea deeply furrowed';
        } elseif ($this === self::VERY_ROUGH()) {
            return 'Sea much disturbed with rollers having steep fronts';
        } elseif ($this === self::HIGH()) {
            return 'Sea much disturbed with rollers having steep fronts (damage to foreshore)';
        } elseif ($this === self::VERY_HIGH()) {
            return 'Towering seas';
        } elseif ($this === self::PHENOMENAL()) {
            return 'Precipitous seas (experienced only in cyclones)';
        }
    }
}
