<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "City Hall";
$load = false;
ob_start();
include "../shared/navbar_page.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<style>
    .text {
        letter-spacing: 10px;
        border-right: 5px solid #000;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        animation:
            typing 2s steps(28),
            cursor .4s step-end infinite alternate;
    }

    @keyframes cursor {
        50% {
            border-color: transparent;
        }
    }

    @keyframes typing {
        from {
            width: 0
        }
    }

    @media (max-width: 768px) {
        .text {
            letter-spacing: 2px;
            border-right: none;
            width: auto;
            white-space: normal;
            overflow: visible;
            animation: none;
        }

        .reverse-flex {
            flex-direction: column;
        }

        .margin-top-20 {
            margin-top: 20%;
        }

        .margin-top-5 {
            margin-top: 5%;
        }
    }
</style>
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<div class="w3-center" style="margin-top:13%;">
    <div class="reverse-flex margin-top-20" style="display:flex; justify-content: space-around; align-items: center;">
        <div>
            <img src="../assets/image/city_logo.svg" alt="City Hall Logo" width="300px">
        </div>
        <div class="margin-top-5">
            <div style="font-size: 30px;margin-bottom: 20px">
                <div style="display:inline-block">
                    <div class="text">Welcome To City Hall!</div>
                </div>
            </div>
            <div style="display:flex;justify-content:space-around;align-items:center">
                <div class="w3-padding" style="margin-left:10px;">
                    <a href="../page/admin_login.php" class="btn btn-primary btn-lg">Admin</a>

                </div>
                <div class="w3-padding" style="margin-left:10px;">
                    <a href="../visitor/visitor_upload_info.php" class="btn btn-primary btn-lg">Log Now</a>

                </div>
            </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>