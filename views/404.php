<?php
include_once __DIR__ . '/../models/session_check.php';
include_once __DIR__ . '/../controllers/page-controller.php';
include_once __DIR__ . '/../helpers/util.php';
include_once __DIR__ . '/../models/dashboard/query_helper.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . '/../includes/dashboard-header-link.php' ?>
    <link rel='stylesheet' type='text/css' href="assets/css/404.css" />
</head>

<body>
    <?php
    include_once __DIR__ . '/../includes/dashboard-navbar.php';
    include_once __DIR__ . '/../includes/dashboard-sidebar.php';
    ?>
    <container class="mainContainer">
        <img src="assets/img/not-found.svg" alt="not-found" class="notFoundImage" />
        <p class="title">Page not found</p>
    </container>

    <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>

</body>

</html>