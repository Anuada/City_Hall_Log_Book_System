<?php

$url = 'https://www.cebucity.gov.ph/pitchV2/employees.php/employees';

$headers = @get_headers($url);

if ($headers === false || strpos($headers[0], '200') === false) {
    http_response_code(500);
    echo json_encode(['message' => "We're having trouble connecting to the server. Please try again later."]);
    exit();
}

$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    http_response_code(500);
    echo json_encode(['message' => 'Request Error: Unable to fetch data']);
    exit();
}

$employee = json_decode($response, true, 512, JSON_OBJECT_AS_ARRAY);
$employees = $employee['employees'];
