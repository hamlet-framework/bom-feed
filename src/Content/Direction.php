<?php

namespace Hamlet\BureauOfMeteorology\Content;

final class Direction extends Enum
{
    public static function CALM(): self
    {
        return static::values()['CALM'];
    }

    public static function E(): self
    {
        return static::values()['E'];
    }

    public static function ENE(): self
    {
        return static::values()['ENE'];
    }

    public static function ESE(): self
    {
        return static::values()['ESE'];
    }

    public static function N(): self
    {
        return static::values()['N'];
    }

    public static function NE(): self
    {
        return static::values()['NE'];
    }

    public static function NNE(): self
    {
        return static::values()['NNE'];
    }

    public static function NNW(): self
    {
        return static::values()['NNW'];
    }

    public static function NW(): self
    {
        return static::values()['NW'];
    }

    public static function S(): self
    {
        return static::values()['S'];
    }

    public static function SE(): self
    {
        return static::values()['SE'];
    }

    public static function SSE(): self
    {
        return static::values()['SSE'];
    }

    public static function SSW(): self
    {
        return static::values()['SSW'];
    }

    public static function SW(): self
    {
        return static::values()['SW'];
    }

    public static function W(): self
    {
        return static::values()['W'];
    }

    public static function WNW(): self
    {
        return static::values()['WNW'];
    }

    public static function WSW(): self
    {
        return static::values()['WSW'];
    }

    protected static function options(): array
    {
        return [
            'CALM',
            'E',
            'ENE',
            'ESE',
            'N',
            'NE',
            'NNE',
            'NNW',
            'NW',
            'S',
            'SE',
            'SSE',
            'SSW',
            'SW',
            'W',
            'WNW',
            'WSW'
        ];
    }
}
