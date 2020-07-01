<?php

use Hamlet\BureauOfMeteorology\Stations;

require_once __DIR__ . '/../vendor/autoload.php';

$properties = [];
foreach (Stations::all() as $station) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $station->feedUrl());
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($handle);
    curl_close($handle);

    $payload = json_decode($content, true);
    foreach ($payload['observations']['data'] as $entry) {
        foreach ($entry as $property => $value) {
            if (!isset($properties[$property])) {
                $properties[$property] = [];
            }
            if (!in_array($value, $properties[$property])) {
                $properties[$property][] = $value;
            }
        }
    }

    ksort($properties);
    file_put_contents(__DIR__  . '/all-properties.json', json_encode($properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
