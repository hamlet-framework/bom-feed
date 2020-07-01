<?php

namespace Hamlet\BureauOfMeteorology\Feed;

class FeedObservations
{
    /**
     * @var FeedNotice[]
     */
    public $notice;

    /**
     * @var FeedHeader[]
     */
    public $header;

    /**
     * @var FeedData[]
     */
    public $data;
}
