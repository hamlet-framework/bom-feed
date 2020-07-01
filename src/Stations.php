<?php

namespace Hamlet\BureauOfMeteorology;

class Stations
{
    /**
     * @var Station[]
     */
    private static $stations = [];

    private function __construct()
    {
    }

    /**
     * @return Station[]
     */
    public static function all(): array
    {
        if (empty(self::$stations)) {
            foreach (file(__DIR__ . '/stations.csv') as $line) {
                list($key, $name, $latitude, $longitude) = explode(',', $line, 2);
                self::$stations[] = new Station(trim($key), trim($name), (float) $latitude, (float) $longitude);
            }
        }
        return self::$stations;
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $count
     * @return Station[]
     */
    public function closestTo(float $latitude, float $longitude, int $count)
    {
        $distances = [];
        foreach (self::all() as $station) {
            $distances[] = [$station->distanceTo($latitude, $longitude), $station];
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
