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
    const EARTH_RADIUS = 6371000;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var float */
    private $height;

    /** @var string[] */
    private $products;

    /**
     * @param int $id
     * @param string $name
     * @param float $latitude
     * @param float $longitude
     * @param float $height
     * @param string[] $products
     */
    public function __construct(int $id, string $name, float $latitude, float $longitude, float $height, array $products)
    {
        $this->id = $id;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->height = $height;
        $this->products = $products;
    }

    public function id(): int
    {
        return $this->id;
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

    public function height(): float
    {
        return $this->height;
    }

    public function products(): array
    {
        return $this->products;
    }

    public function feedUrl(): string
    {
        $product = $this->products[0];
        $id = $this->id;

        return "http://www.bom.gov.au/fwo/${product}/${product}.${id}.json";
    }

    public function feed(): Envelope
    {
        $url = $this->feedUrl();

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($handle);
        curl_close($handle);

        if (!is_string($content) || empty($content)) {
            throw new FeedException('No content for ' . $url);
        }
        $data = _union(_list(_mixed()), _null())->cast(json_decode($content, true));
        if ($data === null) {
            echo $content;
            throw new FeedException('Invalid feed content for ' . $url . '. ' .json_last_error_msg(), json_last_error());
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

        $longitudeDelta = $longitude1 - $longitude0;
        $a = pow(cos($latitude1) * sin($longitudeDelta), 2) +
             pow(cos($latitude0) * sin($latitude1) - sin($latitude0) * cos($latitude1) * cos($longitudeDelta), 2);
        $b = sin($latitude0) * sin($latitude1) + cos($latitude0) * cos($latitude1) * cos($longitudeDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * self::EARTH_RADIUS;
    }
}
