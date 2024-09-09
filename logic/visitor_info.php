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


    $table = "visitor_info";
    $data = array(

        "fname" => $fname,
        "lname" => $lname,
        "purpose" => $purpose,
        "date" => $date,

    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Upload successfully";
    } else {
        $_SESSION["m"] = "Error uploading!";
    }

    header("Location: ../visitor/visitor_upload_info.php");
    exit();
}
