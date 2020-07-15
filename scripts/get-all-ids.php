<?php

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
    'http://www.bom.gov.au/nsw/observations/coastal.shtml',
    'http://www.bom.gov.au/nt/observations/coastal.shtml',
    'http://www.bom.gov.au/qld/observations/coastal.shtml',
    'http://www.bom.gov.au/sa/observations/coastal.shtml',
    'http://www.bom.gov.au/tas/observations/coastal.shtml',
    'http://www.bom.gov.au/vic/observations/coastal.shtml',
    'http://www.bom.gov.au/wa/observations/coastal.shtml',
    'http://reg.bom.gov.au/act/observations/canberra.shtml',
    'http://reg.bom.gov.au/nsw/observations/sydney.shtml',
    'http://reg.bom.gov.au/nt/observations/darwin.shtml',
    'http://reg.bom.gov.au/qld/observations/brisbane.shtml',
    'http://reg.bom.gov.au/sa/observations/adelaide.shtml',
    'http://reg.bom.gov.au/tas/observations/hobart.shtml',
    'http://reg.bom.gov.au/vic/observations/melbourne.shtml',
    'http://reg.bom.gov.au/wa/observations/perth.shtml',
];

$stations = [];
foreach (file(__DIR__ . '/../src/stations.csv') as $line) {
    list($id, $name, $latitude, $longitude, $height, $products) = explode(',', trim($line));
    $id = (int) $id;

    $stations[$id] = [
        'id' => $id,
        'name' => $name,
        'latitude' => (float) $latitude,
        'longitude' => (float) $longitude,
        'height' => (float) $height,
        'products' => $products
    ];
}

$need_update = array_keys($stations);
$processed_ids = [];
foreach ($urls as $url) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($handle);
    curl_close($handle);

    if (preg_match_all('#products/((ID[A-Z0-9]+)/[A-Z0-9]+\.(\d+)).shtml">([^<]+)<#', $content, $matches)) {
        foreach ($matches[3] as $index => $id) {
            $product = $matches[2][$index];
            $name = $matches[4][$index];

            if (isset($processed_ids[$id])) {
                $stations[$id]['products'] .= ':' . $product;
                continue;
            } else {
                $processed_ids[$id] = 1;
            }


            $details_url = "http://www.bom.gov.au/products/${product}/${product}.${id}.shtml";
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

            unset($need_update[$id]);
            $stations[$id] = [
                'id' => $id,
                'name' => $name,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'height' => $height,
                'products' => $product
            ];
        }
    }
}

ksort($stations);
$payload = '';
foreach ($stations as $station) {
    $products = explode(':', $station['products']);
    sort($products);
    $products_string = join(':', array_unique($products));

    $payload .= "$station[id],$station[name],$station[latitude],$station[longitude],$station[height],$products_string\n";
}
file_put_contents(__DIR__ . '/../src/stations.csv', $payload);

return $stations;
