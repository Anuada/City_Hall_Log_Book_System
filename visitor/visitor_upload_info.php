<?php
session_start();

require_once "../util/DbHelper.php";

$db = new DbHelper();

$title = "FORM";


ob_start();

?>
<?php include "../shared/navbar_page.php"; ?>

<title><?php echo $title; ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<div class="container" style="margin-top:5%;">
    <h2>Log Book Form</h2>
    <form action="../logic/visitor_info.php" method="post" enctype="multipart/form-data" id="submitformlegal">

        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
        </div>

        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" placeholder="Enter your purpose here..." rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
        </div>



        <button type="submit" name="submit" class="btn bg-fuchsia text-white">Submit Now</button>
    </form>
</div>


<?php
$content = ob_get_clean();
ob_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
$scripts = ob_get_clean();
require_once "../shared/layout.php";
?>