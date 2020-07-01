<?php

namespace Hamlet\BureauOfMeteorology\Content\AirPressure;

use Hamlet\BureauOfMeteorology\Content\Enum;

final class AirPressureTendency extends Enum
{
    public static function RISING(): self
    {
        return self::values()['R'];
    }

    public static function STEADY(): self
    {
        return self::values()['S'];
    }

    public static function FALLING(): self
    {
        return self::values()['F'];
    }

    protected static function options(): array
    {
        return [
            'R',
            'F',
            'S'
        ];
    }

    public function description(): string
    {
        if ($this === self::RISING()) {
            return 'Rising';
        } elseif ($this === self::STEADY()) {
            return 'Steady';
        } elseif ($this === self::FALLING()) {
            return 'Falling';
        }
    }
}
