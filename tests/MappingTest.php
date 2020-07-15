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
        for ($i = 0; $i < 100; $i++) {
            $station = self::$all[array_rand(self::$all)];
            $station->feed();
            $this->assertTrue(true);
        }
    }

    public function testStationsListIsComplete()
    {
        $stations = require_once(__DIR__ . '/../scripts/get-all-ids.php');
        foreach ($stations as $id => $record) {
            $this->assertArrayHasKey($id, self::$all);

            $station = self::$all[$id];
            $this->assertEquals($record['name'], $station->name());
            $this->assertEqualsWithDelta($record['latitude'], $station->latitude(), 0.01);
            $this->assertEqualsWithDelta($record['longitude'], $station->longitude(), 0.01);
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
