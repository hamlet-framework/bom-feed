<?php

namespace Hamlet\BureauOfMeteorology\Content\Clouds;

use Hamlet\BureauOfMeteorology\Content\Enum;

/**
 * @see https://bmtc.moodle.com.au/mod/book/tool/print/index.php?id=5580
 * @see http://www.bom.gov.au/weather-services/about/cloud/cloud-types.shtml
 * @see http://media.bom.gov.au/social/blog/895/whats-that-cloud/
 */
final class CloudType extends Enum
{
    /**
     * Cirrus: high level, white tufts or filaments; made up of ice crystals.
     * No precipitation.
     * High Level Clouds (above 6 km)
     * @return static
     */
    public static function CIRRUS()
    {
        return static::values()['Cirrus'];
    }

    /**
     * Cirrocumulus: high level, small rippled elements; ice crystals.
     * No precipitation.
     * High Level Clouds (above 6 km).
     * @return static
     */
    public static function CIRROCUMULUS()
    {
        return static::values()['Cirrocumulus'];
    }

    /**
     * Cirrostratus: high level, transparent sheet or veil, halo phenomena; ice crystals.
     * No precipitation.
     * High Level Clouds (above 6 km).
     * @return static
     */
    public static function CIRROSTRATUS()
    {
        return static::values()['Cirrostratus'];
    }

    /**
     * Altocumulus: middle level layered cloud, rippled elements, generally white with some shading.
     * Precipitation: May produce light showers.
     * Middle Level Clouds (2.5 to 6 km).
     * @return static
     */
    public static function ALTOCUMULUS()
    {
        return static::values()['Altocumulus'];
    }

    /**
     * Altostratus: middle level grey sheet, thinner layer allows sun to appear as through ground glass.
     * Precipitation: rain or snow.
     * Middle Level Clouds (2.5 to 6 km).
     * @return static
     */
    public static function ALTOSTRATUS()
    {
        return static::values()['Altostratus'];
    }

    /**
     * Nimbostratus: thicker, darker and lower based sheet.
     * Precipitation: heavier intensity rain or snow.
     * Middle Level Clouds (2.5 to 6 km).
     * @return static
     */
    public static function NIMBOSTRATUS()
    {
        return static::values()['Nimbostratus'];
    }

    /**
     * Stratocumulus: low level layered cloud, series of rounded rolls, generally white.
     * Precipitation: drizzle.
     * Low Level Clouds (below 2.5 km).
     * @return static
     */
    public static function STRATOCUMULUS()
    {
        return static::values()['Stratocumulus'];
    }

    /**
     * Stratus: low level layer or mass, grey, uniform base; if ragged, referred to as 'fractostratus'.
     * Precipitation: drizzle.
     * Low Level Clouds (below 2.5 km).
     * @return static
     */
    public static function STRATUS()
    {
        return static::values()['Stratus'];
    }

    /**
     * Cumulus: low level, individual cells, vertical rolls or towers, flat base.
     * Precipitation: showers or snow.
     * Low Level Clouds (below 2.5 km).
     * @return static
     */
    public static function CUMULUS()
    {
        return static::values()['Cumulus'];
    }

    /**
     * Towering Cumulus: low level, cumulus clouds with considerable vertical growth in the form of rising mounds, domes or towers.
     * Precipitation: showers, snow, or snow pellets.
     * Low Level Clouds (below 2.5 km).
     * @return static
     */
    public static function TOWERING_CUMULUS()
    {
        return static::values()['Towering Cumulus'];
    }

    /**
     * Cumulonimbus: low level, very large cauliflower-shaped towers to 16 km high, often 'anvil tops'.
     * Phenomena: thunderstorms, lightning, squalls.
     * Precipitation: showers or snow.
     * Low Level Clouds (below 2.5 km).
     * @return static
     */
    public static function CUMULONIMBUS()
    {
        return static::values()['Cumulonimbus'];
    }

    protected static function options(): array
    {
        return [
            'Cirrus',
            'Cirrocumulus',
            'Cirrostratus',
            'Altocumulus',
            'Altostratus',
            'Nimbostratus',
            'Stratocumulus',
            'Stratus',
            'Cumulus',
            'Towering Cumulus',
            'Cumulonimbus'
        ];
    }
}
