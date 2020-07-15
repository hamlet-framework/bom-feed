<?php

namespace Hamlet\BureauOfMeteorology;

class Stations
{
    /**
     * @var Station[]
     * @psalm-var array<string,Station>
     */
    private static $stations = [];

    private function __construct()
    {
    }

    /**
     * @return Station[]
     * @psalm-return array<string,Station>
     */
    public static function all(): array
    {
        if (empty(self::$stations)) {
            foreach (file(__DIR__ . '/stations.csv') as $line) {
                list($id, $name, $latitude, $longitude, $height, $products) = explode(',', trim($line));
                self::$stations[$id] = new Station((int) $id, $name, (float) $latitude, (float) $longitude, (float) $height, explode(':', $products));
            }
        }
        return self::$stations;
    }

    /**
     * @param string $key
     * @return Station|null
     */
    public static function byKey(string $key)
    {
        return self::all()[$key] ?? null;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $count
     * @return Station[]
     */
    public static function closestTo(float $latitude, float $longitude, int $count)
    {
        $distances = [];
        foreach (self::all() as $station) {
            $distances[$station->id()] = [$station->distanceTo($latitude, $longitude), $station];
        }
        usort($distances, function (array $a, array $b): int {
            return $a[0] <=> $b[0];
        });
        $stations = array_map(function (array $a) {
            return $a[1];
        }, $distances);

        return array_slice($stations, 0, $count);
    }
}
