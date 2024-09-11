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
            <h2>Logo</h2>

            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="dashboard_admin.php">Dashboard</a></li>
                <li><a href="all_info.php">Reports</a></li>
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
            <div class="well">
                <div class="row table-responsive">
                    <table class="table table-bordered" style="width:98%; margin-left:10px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Purpose</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($visitor as $visitors): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($visitors["id"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($visitors["fname"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($visitors["lname"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($visitors["purpose"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($visitors["type"], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo date('F d, Y h:i A', strtotime(htmlspecialchars($visitors["date"], ENT_QUOTES, 'UTF-8'))); ?>
                                    </td>
                                    <td><a href="edit.php?id=<?php echo urlencode($visitors['id']); ?>"
                                            class="btn btn-primary">Edit</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li>
                            <a href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="<?php echo $i == $page ? 'active' : ''; ?>">
                            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li>
                            <a href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
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