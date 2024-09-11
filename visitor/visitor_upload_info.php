<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../enums/Type.php";

$db = new DbHelper();
$types = array_column(Type::cases(), 'value');
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
            <label for="type">Visitor Type</label>
            <select name="type" id="type" class="form-control">
                <option disabled>SELECT TYPE</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?php echo $type ?>"><?php echo $type ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" placeholder="Enter your purpose here..." rows="4"
                required></textarea>
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

<?php if (isset($_SESSION["fieldInputs"])): ?>
    <script>
        const { fname, lname, type, purpose } = <?php echo json_encode($_SESSION["fieldInputs"]) ?>;
        $("#fname").val(fname);
        $("#lname").val(lname);
        $("#type").val(type);
        $("#purpose").val(purpose);
    </script>
    <?php unset($_SESSION["fieldInputs"]) ?>
<?php endif; ?>
<?php
$scripts = ob_get_clean();
require_once "../shared/layout.php";
?>