<?php

namespace Hamlet\BureauOfMeteorology\Content\Clouds;

use Hamlet\BureauOfMeteorology\Content\Enum;

final class CloudConditionSummary extends Enum
{
    public static function MOSTLY_CLEAR()
    {
        return static::values()['Mostly clear'];
    }

    public static function PARTLY_CLOUDY()
    {
        return static::values()['Partly cloudy'];
    }

    public static function CLEAR()
    {
        return static::values()['Clear'];
    }

    public static function CLOUDY()
    {
        return static::values()['Cloudy'];
    }

    public static function MOSTLY_CLOUDY()
    {
        return static::values()['Mostly cloudy'];
    }

    public static function FOG()
    {
        return static::values()['Fog'];
    }

    protected static function options(): array
    {
        return [
            'Mostly clear',
            'Partly cloudy',
            'Clear',
            'Cloudy',
            'Mostly cloudy',
            'Fog'
        ];
    }
}
