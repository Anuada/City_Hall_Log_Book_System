<?php

session_start();

require_once "../util/DbHelper.php";
require_once "../enums/Type.php";

$db = new DbHelper();
$types = array_column(Type::cases(), 'value');

if (isset($_POST['submit'])) {
    uploadEvents($db, $types);
}

function uploadEvents($db, $types)
{

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $purpose = $_POST['purpose'];
    $type = $_POST['type'];

    $fieldInputs = [
        'fname' => $fname,
        'lname' => $lname,
        'purpose' => $purpose,
        'type' => $type,
    ];

    if (empty(trim($fname)) || empty(trim($lname)) || empty(trim($purpose)) || empty(trim($type))) {
        $_SESSION["m"] = "Fill out the missing fields!";
        $_SESSION["fieldInputs"] = $fieldInputs;
        header("Location: ../visitor/visitor_upload_info.php");
        exit();
    }

    if (!in_array($type, $types)) {
        $_SESSION["m"] = "Invalid Type!";
        $_SESSION["fieldInputs"] = $fieldInputs;
        header("Location: ../visitor/visitor_upload_info.php");
        exit();
    }

    $table = "visitor_info";
    $data = $fieldInputs;

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Visitor Logged Successfully";
    } else {
        $_SESSION["m"] = "Error Logging!";
    }

    header("Location: ../visitor/visitor_upload_info.php");
    exit();
}
