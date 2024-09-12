<?php
session_start();
require_once "../util/DbHelper.php";

$db = new DbHelper();
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$recordsPerPage = 10;
$start = ($page - 1) * $recordsPerPage;
$visitor = $db->fetchRecords_limit("visitor_info", $start, $recordsPerPage);
$totalRecords = $db->fetchTotalRecords("visitor_info");
$totalPages = ceil($totalRecords / $recordsPerPage);
$allClients = $db->allClients();

$title = "City Hall";
$load = false;
ob_start();
include "../shared/navbar_page.php";
$navbar = ob_get_clean();
?> 

<?php ob_start() ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/admin_dashboard.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
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
                <li><a href="all_info.php">Reports</a></li>
                <li><a href="#">#</a></li>
                <li><a href="#">#</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
    <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 5px; margin-top:20px;">
        <img src="../assets/image/city_logo.svg" alt="Logo" class="card-img-top" style="max-width: 50%; height: auto; margin: 0 auto; display: block;">
        
    </div>
    <br>
    <ul class="nav nav-pills nav-stacked mt-3">
        <li class="active"><a href="dashboard_admin.php">Dashboard</a></li>
        <li><a href="all_info.php">Reports</a></li>
        <li><a href="#section3">#</a></li>
        <li><a href="#section4">#</a></li>  
    </ul>
</div>
        <br>

        <div class="col-sm-9">
            <div class="well">
                <h4>All Logs</h4>
                <p></p>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="well">  
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Purpose</th>
                        </tr>
                    </thead>
                    <tbody id="modalBody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="../assets/js/log.calendar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>