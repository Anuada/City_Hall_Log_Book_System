<?php

$url = 'https://www.cebucity.gov.ph/pitchV2/employees.php/employees';

$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    echo 'Request Error: Unable to fetch data';
    exit();
} else {
    $employee = json_decode($response, true, 512, JSON_OBJECT_AS_ARRAY);
    $employees = $employee['employees'];

}
