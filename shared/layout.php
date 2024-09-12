<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1.0, safari">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/w3.css">
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/loader.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <?php echo (isset($styles)) ? $styles : "" ?>
    <title>
        <?php echo (isset($title)) ? "Log Book | " . $title : "" ?>
    </title>
</head>

<body>

    <div class="loader" id="loadingModal">
        <div class="dot dot-1"></div>
        <div class="dot dot-2"></div>
        <div class="dot dot-3"></div>
        <div class="dot dot-4"></div>
        <div class="dot dot-5"></div>
    </div>

    <?php echo isset($navbar) ? $navbar : "" ?>

    <!-- Content of the page -->
    <?php echo $content ?>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/loader.js"></script>
    <script src="../assets/js/formatter.js"></script>

    <!-- <script src="../assets/js/prompt.js"></script> -->

    <?php if (isset($_SESSION["m"])): ?>
        <?php
        $m = $_SESSION["m"];
        $i = strlen($m) - 1;
        ?>
        <?php if ($m[$i] != "!"): ?>
            <?php $m = $m . "!" ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '<?php echo $m ?>',
                    confirmButtonColor: '#5DB075',
                    timer: 2000
                });
            </script>
        <?php else: ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo $m ?>',
                    confirmButtonColor: '#d33',
                    timer: 2000
                });
            </script>
        <?php endif; ?>
        <?php unset($_SESSION["m"]) ?>
    <?php endif; ?>

    <?php echo (isset($scripts)) ? $scripts : "" ?>
</body>

</html>