<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "City Hall";
$load = false;
ob_start();
include "../shared/navbar_page.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/w3.css">
<link rel="stylesheet" href="../assets/css/body.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>




<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>