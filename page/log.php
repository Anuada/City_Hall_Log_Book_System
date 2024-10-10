<?php
session_start();

$title = "Log Form";

ob_start();
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/log.css">
<link rel="stylesheet" href="../assets/css/background_indext.css">
<link rel="stylesheet" href="../assets/css/loader.spinner.css">
<?php $styles = ob_get_clean() ?>
<?php ob_start() ?>

<div id="div_container" class="reverse-flex margin-top-20"
    style="display:flex; justify-content: space-around; align-items: center;">
    <div class="margin-top-5">
        <div id="select_button" style="display:flex;justify-content:space-evenly;align-items:center;height:100vh">
            <div class="w3-padding" style="margin-left:10px">
                <button class="btn ch-green btn-lg choice" id="employee">Employee</button>
            </div>
            <div class="w3-padding" style="margin-left:10px">
                <button class="btn ch-green btn-lg choice" id="visitor">Visitor</button>
            </div>
        </div>

        <div id="log_book_form" class="container div-margin-top log-form-width" style="display:none"></div>
    </div>
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