<?php

namespace Hamlet\BureauOfMeteorology;

use Hamlet\BureauOfMeteorology\Feed\Envelope;
use Hamlet\BureauOfMeteorology\Feed\FeedException;
use Hamlet\Cast\CastException;
use Hamlet\JsonMapper\JsonMapper;
use function Hamlet\Cast\_class;
use function Hamlet\Cast\_list;
use function Hamlet\Cast\_mixed;
use function Hamlet\Cast\_null;
use function Hamlet\Cast\_union;

class Station
{
    public const EARTH_RADIUS = 6371000;

    /** @var string */
    private $key;

    /** @var string */
    private $name;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    public function __construct(string $key, string $name, float $latitude, float $longitude)
    {
        $this->key = $key;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function feedUrl(): string
    {
        return "http://www.bom.gov.au/fwo/{$this->key}.json";
    }

    public function feed(): Envelope
    {
        $url = $this->feedUrl();

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($handle);
        curl_close($handle);

        if (!is_string($content)) {
            throw new FeedException('No content for ' . $url);
        }
        $data = _union(_list(_mixed()), _null())->cast(json_decode($content, true));
        if ($data === null) {
            throw new FeedException(json_last_error_msg(), json_last_error());
        }
        try {
            return JsonMapper::map(_class(Envelope::class), $data);
        } catch (CastException $exception) {
            throw new FeedException('Cannot parse feed', 0, $exception);
        }
    }

    public function distanceTo(float $latitude, float $longitude): float
    {
        $latitude0  = deg2rad($latitude);
        $longitude0 = deg2rad($longitude);
        $latitude1  = deg2rad($this->latitude);
        $longitude1 = deg2rad($this->longitude);

        $lonDelta = $longitude1 - $longitude0;
        $a = pow(cos($latitude1) * sin($lonDelta), 2) +
             pow(cos($latitude0) * sin($latitude1) - sin($latitude0) * cos($latitude1) * cos($lonDelta), 2);
        $b = sin($latitude0) * sin($latitude1) + cos($latitude0) * cos($latitude1) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * self::EARTH_RADIUS;
    }
}
