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

$stations = [];
foreach ($urls as $url) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($handle);
    curl_close($handle);

    if (preg_match_all('#products/(ID[^.]+.\d+).shtml">([^<]+)<#', $content, $matches)) {
        foreach ($matches[1] as $index => $key) {
            $name = $matches[2][$index];

            $details_url = "http://www.bom.gov.au/products/${key}.shtml";
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $details_url);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
            $details_content = curl_exec($handle);
            curl_close($handle);

            if (preg_match_all('#<b>(Lat|Lon|Height):</b>([^<]+)</#m', $details_content, $details_matches)) {
                $latitude = (float) $details_matches[2][0];
                $longitude = (float) $details_matches[2][1];
                $height = (float) $details_matches[2][2];
            }

            $stations[$key] = [$key, $name, $latitude, $longitude, $height];
        }
    }
}

ksort($stations);
$payload = '';
foreach ($stations as $key => list($key, $name, $latitude, $longitude, $height)) {
    $payload .= "$key,$name,$latitude,$longitude,$height\n";
}
file_put_contents(__DIR__ . '/../src/stations.csv', $payload);

return $stations;
