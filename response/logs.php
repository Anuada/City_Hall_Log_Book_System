<?php

include "../util/DbHelper.php";

$db = new DbHelper();

header("Content-Type: application/json");

echo json_encode($db->getAllLogs());