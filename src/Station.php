<?php

namespace Hamlet\BureauOfMeteorology;

use Hamlet\BureauOfMeteorology\Content\Observations;
use Hamlet\BureauOfMeteorology\Feed\FeedException;
use Hamlet\BureauOfMeteorology\Feed\FeedEnvelope;
use Hamlet\Cast\CastException;
use Hamlet\JsonMapper\JsonMapper;
use function Hamlet\Cast\_class;

class Station
{
    /** @var string */
    private $key;

    /** @var string */
    private $name;

    public function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function feedUrl()
    {
        return "http://www.bom.gov.au/fwo/{$this->key}.json";
    }

    public function observations(): FeedEnvelope
    {
        $url = $this->feedUrl();

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($handle);
        curl_close($handle);

        if (empty($content)) {
            throw new FeedException('No content for ' . $url);
        }
        try {
            /** @var FeedEnvelope $feed */
            $feed = JsonMapper::map(_class(FeedEnvelope::class), json_decode($content, true));
        } catch (CastException $exception) {
            throw new FeedException('Cannot parse feed', 0, $exception);
        }

        return $feed;
    }
}
