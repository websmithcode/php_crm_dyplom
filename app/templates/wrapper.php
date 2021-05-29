<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageData['title']; ?></title>
    <meta name="vieport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= CSS_URI ?>style.css">
    <?php
    if (file_exists(ROOT . $pageData['styleCSS'])):
        printf("<link rel='stylesheet' href='%s'>", $pageData['styleCSS']);
    endif;
    ?>
</head>
<body class="d-flex">
<div class="sidebar">
    <?php include('blocks/sidebar.php'); ?>
</div>

<div id="content" class="w-100">
    <?php include($tpl); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
<script src="<?= JS_URI ?>script.js"></script>
<?php
if (file_exists(ROOT . $pageData['scriptJS'])):
    printf("<script src='%s'></script>", $pageData['scriptJS']);
endif;
?>


</body>
</html>
