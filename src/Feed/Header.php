<?php

namespace Hamlet\BureauOfMeteorology\Feed;

class Header
{
    /**
     * @var string
     */
    public $refresh_message;

    /**
     * @var string
     */
    public $ID;

    /**
     * @var string
     */
    public $main_ID;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $state_time_zone;

    /**
     * @var string
     */
    public $time_zone;

    /**
     * @var string
     */
    public $product_name;

    /**
     * @var string
     * @psalm-var 'Northern Territory'|'New South Wales'|'South Australia'|'Western Australia'|'Tasmania'|'Queensland'|'Victoria'
     */
    public $state;
}
