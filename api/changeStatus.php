<?php
session_start();

header("Content-Type: application/json");

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized Access']);
    exit();
}

include "../util/database/DbHelper.php";
include "../enums/Status.php";

$db = new DbHelper();
$statuses = Status::all();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed', 'success' => false]);
    exit();
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Check for 'ids' array and 'status'
$ids = isset($data['ids']) ? $data['ids'] : [];
$status = isset($data['status']) ? $data['status'] : '';

// Initialize an array to track missing fields
$missingFields = [];

if (empty($ids)) {
    $missingFields[] = 'ids';
}
if (empty($status)) {
    $missingFields[] = 'status';
}

if (!empty($missingFields)) {
    echo json_encode(['message' => 'Missing fields: ' . implode(', ', $missingFields), 'success' => false]);
    exit();
}

if (!in_array($status, $statuses)) {
    http_response_code(404);
    echo json_encode(['message' => 'Incorrect Status', 'success' => false]);
    exit();
}

// Process each id and update the status
$updateStatusSuccess = false;
foreach ($ids as $id) {
    $updateStatus = $db->updateRecord('visitor_info', ['id' => $id, 'status' => $status]);
    if ($updateStatus > 0) {
        $updateStatusSuccess = true;
    }
}

if ($updateStatusSuccess) {
    echo json_encode(['message' => 'Status Updated Successfully', 'success' => true]);
} else {
    echo json_encode(['message' => 'Error Updating Status', 'success' => false]);
}
