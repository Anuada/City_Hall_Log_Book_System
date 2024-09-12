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

<i class='fas fa-home'></i>
<span style="margin-left: 10px">Dashboard</span>

<?php $header = ob_get_clean() ?>

<?php ob_start() ?>

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
                    <td><a href="edit.php?id=<?php echo urlencode($visitors['id']); ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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


<?php $admin_content = ob_get_clean() ?>

<?php require_once "../shared/sidebar.admin.php"; ?>