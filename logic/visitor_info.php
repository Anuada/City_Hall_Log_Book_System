<?php

session_start();

require_once "../util/DbHelper.php";

$db = new DbHelper();

if (isset($_POST['submit'])) {
    uploadEvents($db);
}

function uploadEvents($db)
{

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $purpose = $_POST['purpose'];
    $date = $_POST['date'];

    if (empty(trim($fname)) && empty(trim($lname)) && empty(trim($purpose)) && empty(trim($date))) {
        $_SESSION["m"] = "Fill out the missing fields!";
        header("Location: ../visitor/visitor_upload_info.php");
        exit();
    }

    $table = "visitor_info";
    $data = array(

        "fname" => $fname,
        "lname" => $lname,
        "purpose" => $purpose,
        "date" => $date,

    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Visitor Logged Successfully";
    } else {
        $_SESSION["m"] = "Error Logging!";
    }

    header("Location: ../visitor/visitor_upload_info.php");
    exit();
}
