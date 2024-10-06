<?php

require_once "database/drop/DbDrop.php";

$dbDrop = new DbDrop();

echo $dbDrop->drop();