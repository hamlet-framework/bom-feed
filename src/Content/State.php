<?php

namespace Hamlet\BureauOfMeteorology\Content;

use Generator;

final class State extends Enum
{
    public static function NORTHERN_TERRITORY(): self
    {
        return self::values()['Northern Territory'];
    }

    public static function NEW_SOUTH_WALES(): self
    {
        return self::values()['New South Wales'];
    }

    public static function SOUTH_AUSTRALIA(): self
    {
        return self::values()['South Australia'];
    }

    public static function WESTERN_AUSTRALIA(): self
    {
        return self::values()['Western Australia'];
    }

    public static function QUEENSLAND(): self
    {
        return self::values()['Queensland'];
    }

    public static function VICTORIA(): self
    {
        return self::values()['Victoria'];
    }

    public static function TASMANIA(): self
    {
        return self::values()['Tasmania'];
    }

    /**
     * @return string[]
     */
    protected static function options(): array
    {
        return [
            'Northern Territory',
            'New South Wales',
            'South Australia',
            'Western Australia',
            'Tasmania',
            'Queensland',
            'Victoria'
        ];
    }
}
