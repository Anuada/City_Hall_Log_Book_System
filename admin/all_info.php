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
?>

<?php ob_start() ?>
<i class="fas fa-file"></i>
<span style="margin-left: 10px">Reports</span>
<?php $header = ob_get_clean() ?>

<?php ob_start() ?>
<link href="../assets/css/calendar.css" rel="stylesheet">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<div id="calendar"></div>
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search...">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Purpose</th>
                                <th>Type</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="modalBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $admin_content = ob_get_clean() ?>

<?php ob_start() ?>
<script type="module" src="../assets/js/log.calendar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/sidebar.admin.php" ?>