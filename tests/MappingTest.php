<?php

namespace Hamlet\BureauOfMeteorology;

use PHPUnit\Framework\TestCase;

class MappingTest extends TestCase
{
    public function testAllStations()
    {
        $stations = Stations::all();

        foreach($stations as $station) {
            $feed = $station->feed();

            $latitude  = $feed->observations->data[0]->lat;
            $longitude = $feed->observations->data[0]->lon;

            $this->assertEquals($latitude,  $station->latitude());
            $this->assertEquals($longitude, $station->longitude());

            $this->assertTrue(true);
        }
    }

    public function testClosestTo()
    {
        $stations = Stations::closestTo(-37.81, 144.96, 5);
        $names = array_map(function (Station $station): string {
            return $station->name();
        }, $stations);
        $this->assertEquals([], $names);
    }
}
