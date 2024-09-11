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

<div class="w3-center" style="margin-top:20%;">
    <div class="w3-bar w3-blue w3-wide w3-padding w3-card" style="margin-left:10px;">
        <a href="../admin/dashboard_admin.php" class="w3-bar-item w3-button">Admin</a>

    </div>
    <div class="w3-bar w3-blue w3-wide w3-padding w3-card" style="margin-left:10px;">
        <a href="../visitor/visitor_upload_info.php" class="w3-bar-item w3-button">Visitor</a>

    </div>
    <div class="w3-bar w3-blue w3-wide w3-padding w3-card" style="margin-left:10px;">
        <a href="../visitor/employee_upload_info.php" class="w3-bar-item w3-button">Employee</a>

    </div>
</div>


<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>