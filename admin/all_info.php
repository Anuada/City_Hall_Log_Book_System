<?php
session_start();
require_once "../util/DbHelper.php";

$db = new DbHelper();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$recordsPerPage = 10;
$start = ($page - 1) * $recordsPerPage;
$visitor = $db->fetchRecords_limit("visitor_info", $start, $recordsPerPage);
$totalRecords = $db->fetchTotalRecords("visitor_info");
$totalPages = ceil($totalRecords / $recordsPerPage);

$title = "City Hall";
$load = false;
ob_start();
include "../shared/navbar_page.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/admin_dashboard.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<br><br><br>

<nav class="navbar navbar-inverse visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="dashboard_admin.php">Dashboard</a></li>
                <li><a href="all_info.php">All Log book</a></li>
                <li><a href="#">Gender</a></li>
                <li><a href="#">Geo</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
            <h2>Logo</h2>

            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="dashboard_admin.php">Dashboard</a></li>
                <li><a href="all_info.php">All Log Book</a></li>
                <li><a href="#section3">#</a></li>
                <li><a href="#section4">#</a></li>
            </ul><br>
        </div>
        <br>

        <div class="col-sm-9">
            <div class="well">
                <h4>Dashboard</h4>
                <p>Some text..</p>
            </div>



        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>