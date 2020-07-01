<?php

namespace Hamlet\BureauOfMeteorology\Feed;

class Data
{
    /**
     * @var int
     */
    public $sort_order;

    /**
     * @var int
     */
    public $wmo;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $history_product;

    /**
     * @var string
     */
    public $local_date_time;

    /**
     * @var string
     */
    public $local_date_time_full;

    /**
     * @var string
     */
    public $aifstime_utc;

    /**
     * @var int|float
     */
    public $lat;

    /**
     * @var int|float
     */
    public $lon;

    /**
     * @var int|float
     */
    public $apparent_t;

    /**
     * @var string
     * @psalm-var '-'|'Mostly clear'|'Partly cloudy'|'Clear'|'Cloudy'|'Mostly cloudy'|'Fog'
     */
    public $cloud;

    /**
     * @var int|null
     */
    public $cloud_base_m;

    /**
     * @var int|null
     * @psalm-var 0|1|2|3|4|5|6|7|8|9|null
     */
    public $cloud_oktas;

    /**
     * @var string
     * @psalm-var '-'|'Cirrus'|'Cirrocumulus'|'Cirrostratus'|'Altocumulus'|'Altostratus'|'Nimbostratus'|'Stratocumulus'|'Stratus'|'Cumulus'|'Towering Cumulus'|'Cumulonimbus'
     */
    public $cloud_type;

    /**
     * @var int|null
     */
    public $cloud_type_id;

    /**
     * @var int|float|null
     */
    public $delta_t;

    /**
     * @var int|float|null
     */
    public $air_temp;

    /**
     * @var int|float|null
     */
    public $dewpt;

    /**
     * @var int|float|null
     */
    public $press;

    /**
     * @var int|float|null
     */
    public $press_msl;

    /**
     * @var int|float|null
     */
    public $press_qnh;

    /**
     * @var string
     * @psalm-var '-'|'R'|'F'|'S'
     */
    public $press_tend;

    /**
     * @var string
     * @psalm-var numeric-string|'-'
     */
    public $rain_trace;

    /**
     * @var int|null
     */
    public $rel_hum;

    /**
     * @var 'Calm'|'&lt;0.1'|'&lt;0.5'|'1'|'2'|'3'|'4'|'5'|'-'
     */
    public $sea_state;

    /**
     * @var string|null
     * @psalm-var 'E'|'ENE'|'ESE'|'N'|'NE'|'NNE'|'NNW'|'NW'|'S'|'SE'|'SSE'|'SSW'|'SW'|'W'|'WNW'|'WSW'|'-'
     */
    public $swell_dir_worded;

    /**
     * @var float|null
     */
    public $swell_height;

    /**
     * @var int|null
     */
    public $swell_period;

    /**
     * @var string
     * @psalm-var numeric-string|'-'
     */
    public $vis_km;

    /**
     * @var string
     */
    public $weather;

    /**
     * @var string
     * @psalm-var 'CALM'|'E'|'ENE'|'ESE'|'N'|'NE'|'NNE'|'NNW'|'NW'|'S'|'SE'|'SSE'|'SSW'|'SW'|'W'|'WNW'|'WSW'|'-'
     */
    public $wind_dir;

    /**
     * @var int|null
     */
    public $wind_spd_kmh;

    /**
     * @var int|null
     */
    public $wind_spd_kt;

    /**
     * @var int|null
     */
    public $gust_kmh;

    /**
     * @var int|null
     */
    public $gust_kt;
}
