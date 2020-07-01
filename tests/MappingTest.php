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
}
