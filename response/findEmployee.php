<?php

include "../util/DbHelper.php";

$db = new DbHelper();

header("Content-Type: application/json");

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    http_response_code(422);
    echo json_encode(['message' => 'fill out the \'id\' parameter']);
    exit();
}

$id = $_GET['id'];

$findEmployee = $db->fetchRecord('employee_info', ['tin_number' => $id]);

if (empty($findEmployee)) {
    http_response_code(404);
    echo json_encode(['message' => 'employee not found']);
    exit();
} else {
    http_response_code(200);
    echo json_encode(['data' => $findEmployee['fname'] . ' ' . $findEmployee['lname']]);
    exit();
}