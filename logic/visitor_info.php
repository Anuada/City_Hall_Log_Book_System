<?php

session_start();

require_once "../util/DbHelper.php";
require_once "../enums/Type.php";

$db = new DbHelper();
$types = array_column(Type::cases(), 'value');

if (isset($_POST['submit'])) {
    uploadEvents($db, $types);
}

function uploadEvents(DbHelper $db, array $types)
{

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $purpose = $_POST['purpose'];
    $type = $_POST['type'];
    $office = $_POST['office'];

    $fieldInputs = [
        'fname' => $fname,
        'lname' => $lname,
        'purpose' => $purpose,
        'type' => $type,
        'office' => $office,
    ];

    $errorMessages = [];

    foreach ($fieldInputs as $key => $value) {
        if (empty(trim($value))) {
            $errorMessages[$key] = field($key) . " Field Is Required";
        }
    }

    if (!empty($errorMessages)) {
        $_SESSION["fieldInputs"] = $fieldInputs;
        $_SESSION["errorMessages"] = $errorMessages;
        header("Location: ../visitor/visitor_upload_info.php");
        exit();
    }

    if (!in_array($type, $types)) {
        $errorMessages['type'] = "Invalid Type!";
        $_SESSION["errorMessages"] = $errorMessages;
        $_SESSION["fieldInputs"] = $fieldInputs;
        header("Location: ../visitor/visitor_upload_info.php");
        exit();
    }

    $success = $db->addRecord("visitor_info", $fieldInputs);

    if ($success) {
        $_SESSION["m"] = "Visitor Logged Successfully";
    } else {
        $_SESSION["m"] = "Error Logging!";
    }

    header("Location: ../visitor/visitor_upload_info.php");
    exit();
}

function field(string $key)
{
    switch ($key) {
        case 'fname':
            return 'First Name';

        case 'lname':
            return 'Last Name';

        default:
            return ucwords($key);
    }
}