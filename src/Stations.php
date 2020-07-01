<?php

namespace Hamlet\BureauOfMeteorology;

class Stations
{
    private function __construct()
    {
    }

    /**
     * @return Station[]
     */
    public static function all(): array
    {
        static $all;
        if (!isset($all)) {
            $all = [];
            foreach (file(__DIR__ . '/stations.csv') as $line) {
                list($key, $name) = explode(',', $line, 2);
                $all[] = new Station(trim($key), trim($name));
            }
        }
        return $all;
    }
}
