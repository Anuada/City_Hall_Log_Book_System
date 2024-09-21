<?php

include "../util/DbHelper.php";

$db = new DbHelper();

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Method Not Allowed', 'success' => false]);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$id = isset($data['id']) ? $data['id'] : '';
$status = isset($data['status']) ? $data['status'] : '';

if (empty($id) || empty($status)) {
    echo json_encode(['message' => 'Fill out the missing fields', 'success' => false]);
    exit();
}

$updateStatus = $db->updateRecord('visitor_info', ['id' => $id, 'status' => $status]);

if ($updateStatus > 0) {
    echo json_encode(['message' => 'Status Updated Successfully', 'success' => true]);
} else {
    echo json_encode(['message' => 'Error Updating Status', 'success' => false]);
}