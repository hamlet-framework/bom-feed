<?php

namespace Hamlet\BureauOfMeteorology;

use PHPUnit\Framework\TestCase;

class MappingTest extends TestCase
{
    /**
     * @var Station[]
     */
    private static $all = [];

    public static function setUpBeforeClass()
    {
        self::$all = Stations::all();
        parent::setUpBeforeClass();
    }

    public function testFieldMapping()
    {
        foreach(self::$all as $station) {
            $station->feed();
            $this->assertTrue(true);
        }
    }

    public function testStationsListIsComplete()
    {
        $stations = require_once(__DIR__ . '/../scripts/get-all-ids.php');
        foreach ($stations as $key => list($_, $name, $latitude, $longitude)) {
            $this->assertArrayHasKey($key, self::$all);

            $station = self::$all[$key];
            $this->assertEquals($name, $station->name());
            $this->assertEqualsWithDelta($latitude, $station->latitude(), 0.01);
            $this->assertEqualsWithDelta($longitude, $station->longitude(), 0.01);
        }
    }

    public function testClosestTo()
    {
        $stations = Stations::closestTo(-37.81, 144.96, 5);
        $names = array_map(function (Station $station): string {
            return $station->name();
        }, $stations);
        $this->assertEquals([
            'Melbourne (Olympic Park)',
            'St Kilda Harbour RMYS',
            'Essendon Airport',
            'Viewbank',
            'Fawkner Beacon',
        ], $names);
    }
}
