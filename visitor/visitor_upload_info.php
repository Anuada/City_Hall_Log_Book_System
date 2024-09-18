<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../enums/Type.php";

$db = new DbHelper();
$types = array_column(Type::cases(), 'value');
$title = "Log Form";

ob_start();
include "../shared/navbar_page.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<style>
    .text-danger {
        color: rgb(220 53 69);
    }

    .div-margin-top {
        margin-top: 7%;
    }

    @media (max-width: 768px) {
        .div-margin-top {
            margin-top: 13%;
        }
    }
</style>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<div class="container div-margin-top">
    <h2>Log Book Form</h2>
    <form action="../logic/visitor_info.php" method="post">

    <div class="form-group">
            <label for="type">Visitor Type</label>
            <select name="type" id="type" class="form-control">
                <option disabled>SELECT TYPE</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?php echo $type ?>"><?php echo $type ?></option>
                <?php endforeach ?>
            </select>
            <div class="form-text text-danger" id="errorType"></div>
        </div>

        <div class="form-group">
    <label for="type">Select Type of Office</label>
    <select id="office" name="office" class="form-control">
        <option value="Office1">Office1</option>
        <option value="Office2">Office2</option>
    </select>
    <div class="form-text text-danger" id="errorType"></div>
</div>

        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
            <div class="form-text text-danger" id="errorFName"></div>
        </div>

        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
            <div class="form-text text-danger" id="errorLName"></div>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>
            <textarea class="form-control" id="purpose" name="purpose" placeholder="Enter your purpose here..."
                rows="4"></textarea>
            <div class="form-text text-danger" id="errorPurpose"></div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary text-white">Submit Now</button>
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

<?php if (isset($_SESSION["errorMessages"])): ?>
    <script>
        const errorMessages = <?php echo json_encode($_SESSION["errorMessages"]) ?>;
        $("#errorFName").text(errorMessages.fname);
        $("#errorLName").text(errorMessages.lname);
        $("#errorType").text(errorMessages.type);
        $("#errorPurpose").text(errorMessages.purpose);
    </script>
    <?php unset($_SESSION["errorMessages"]) ?>
<?php endif; ?>

<?php
$scripts = ob_get_clean();
require_once "../shared/layout.php";
?>