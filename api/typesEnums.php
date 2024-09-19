<?php

require_once "../enums/Type.php";
require_once "../enums/Office.php";

$types = Type::all();
$offices = Office::all();

header("Content-Type: application/json");

echo json_encode($types);