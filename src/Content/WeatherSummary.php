<?php

namespace Hamlet\BureauOfMeteorology\Content;

final class WeatherSummary extends Enum
{
    public static function FINE(): self
    {
        return static::values()['Fine'];
    }

    public static function FOG_PATCHES(): self
    {
        return static::values()['Fog patches'];
    }

    public static function SMOKE(): self
    {
        return static::values()['Smoke'];
    }

    public static function RECENT_PRECIPITATION(): self
    {
        return static::values()['Recent precip.'];
    }

    public static function HAZE(): self
    {
        return static::values()['Haze'];
    }

    public static function RAIN(): self
    {
        return static::values()['Rain'];
    }

    public static function SHOWERS(): self
    {
        return static::values()['Showers'];
    }

    public static function DRIZZLE(): self
    {
        return static::values()['Drizzle'];
    }

    public static function SNOW_SHOWERS(): self
    {
        return static::values()['Snow showers'];
    }

    public static function DISTANT_FOG(): self
    {
        return static::values()['Distant fog'];
    }

    public static function FOG(): self
    {
        return static::values()['Fog'];
    }

    public static function MIST(): self
    {
        return static::values()['Mist'];
    }

    public static function SHALLOW_FOG(): self
    {
        return static::values()['Shallow fog'];
    }

    public static function DISTANT_PRECIPITATION(): self
    {
        return static::values()['Distant precip.'];
    }

    public static function DUST(): self
    {
        return static::values()['Dust'];
    }

    public static function SNOW(): self
    {
        return static::values()['Snow'];
    }

    public static function BLOWING_SNOW(): self
    {
        return static::values()['Blowing snow'];
    }

    protected static function options(): array
    {
        return [
            'Fine',
            'Fog patches',
            'Smoke',
            'Recent precip.',
            'Haze',
            'Rain',
            'Showers',
            'Drizzle',
            'Snow showers',
            'Distant fog',
            'Fog',
            'Mist',
            'Shallow fog',
            'Distant precip.',
            'Dust',
            'Snow',
            'Blowing snow'
        ];
    }
}
