<?php

use Hamlet\BureauOfMeteorology\Station;

require_once __DIR__ . '/../vendor/autoload.php';

$urls = [
    'http://www.bom.gov.au/vic/observations/vicall.shtml',
    'http://www.bom.gov.au/nsw/observations/nswall.shtml',
    'http://www.bom.gov.au/qld/observations/qldall.shtml',
    'http://www.bom.gov.au/wa/observations/waall.shtml',
    'http://www.bom.gov.au/sa/observations/saall.shtml',
    'http://www.bom.gov.au/tas/observations/tasall.shtml',
    'http://www.bom.gov.au/nt/observations/ntall.shtml',
    'http://www.bom.gov.au/ant/observations/antall.shtml',
];

$keys = [];
foreach ($urls as $url) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($handle);
    curl_close($handle);

    if (preg_match_all('#products/(ID[^.]+.\d+).shtml">([^<]+)<#', $content, $matches)) {
        foreach ($matches[1] as $index => $key) {
            $name = $matches[2][$index];
            $keys[$key] = $name;
        }
    }
}

ksort($keys);
$data = '';
foreach ($keys as $key => $name) {
    $station = new Station($key, $name, 0.0, 0.0);
    $feed = $station->feed();

    $latitude = $feed->observations->data[0]->lat;
    $longitude = $feed->observations->data[0]->lon;

    $data .= "$key,$name,$latitude,$longitude\n";
}
file_put_contents(__DIR__ . '/../src/stations.csv', $data);
