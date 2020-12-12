<?php

namespace Hamlet\BureauOfMeteorology;

use Hamlet\Cast\CastException;
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
        $this->assertTrue(true);
        for ($i = 0; $i < 100; $i++) {
            $station = self::$all[array_rand(self::$all)];
            try {
                $station->feed();
            } catch (CastException $exception) {
                $this->fail($exception->getMessage());
            }
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
        $stations = Stations::closestTo(-23.69, 133.88, 5);
        $names = array_map(function (Station $station): string {
            return $station->name();
        }, $stations);
        $this->assertEquals([
            'Alice Springs Airport',
            'Arltunga',
            'Territory Grape Farm',
            'Jervois',
            'Watarrka',
        ], $names);
    }
}
