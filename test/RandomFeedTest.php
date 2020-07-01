<?php

namespace Hamlet\BureauOfMeteorology;

use PHPUnit\Framework\TestCase;

class RandomFeedTest extends TestCase
{
    public function testAllStations()
    {
        $stations = Stations::all();

        foreach($stations as $station) {
            $observations = $station->observations();
            $this->assertTrue(true);
        }
    }
}
