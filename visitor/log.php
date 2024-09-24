<?php
session_start();

require_once "../util/DbHelper.php";
require_once "../enums/Type.php";
require_once "../enums/Office.php";

$db = new DbHelper();
$employees = $db->fetchRecords('employee_info');
$types = Type::all();
$offices = Office::all();
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
    <form id="log_form">
        <div class="form-group">
            <label for="type">Visitor Type</label>
            <select name="type" id="type" class="form-control">
                <option disabled selected hidden>SELECT TYPE</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?php echo $type ?>"><?php echo $type ?></option>
                <?php endforeach ?>
            </select>
            <div class="form-text text-danger" id="errorType"></div>
        </div>

        <div id="employee_info" style="display: none">
            <div class="form-group">
                <label for="employee_id">Employee ID</label>
                <input list="employees" class="form-control" id="employee_id" name="employee_id"
                    placeholder="Select Employee ID">
                <datalist id="employees">
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo $employee['tin_number'] ?>">
                            <?php echo $employee['tin_number'] . ' - ' . $employee['lname'] ?>
                        </option>
                    <?php endforeach ?>
                </datalist>
                <div class="form-text text-danger" id="errorEmployeeId"></div>
            </div>
            <div id="employeeInfoContainer"></div>
        </div>

        <div id="visitor_info" style="display: none">
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
                <label for="office">Office</label>
                <input type="text" class="form-control" id="office" name="office" placeholder="Input Office">
                <div class="form-text text-danger" id="errorOffice"></div>
            </div>
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

<script type="module" src="../assets/js/log.form.js"></script>

<?php
$scripts = ob_get_clean();
require_once "../shared/layout.php";
?>