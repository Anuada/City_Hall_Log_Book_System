<?php

include "../util/DbHelper.php";

$db = new DbHelper();

header("Content-Type: application/json");

if (!isset($_GET['month'])) {
    http_response_code(404);
    echo json_encode('Input the month');

}
$month = $_GET['month'];

$visitor_count = $db->allClients($month);

echo json_encode($visitor_count);
