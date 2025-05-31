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
    <link rel='stylesheet' type='text/css' href="assets/css/add-blood-test.css" />
</head>

<body>

    <?php include_once __DIR__ . '/../includes/dashboard-navbar.php' ?>
    <?php include_once __DIR__ . '/../includes/dashboard-sidebar.php' ?>


    <main id="main" class="main">
        <!-- Title -->
        <div class="pagetitle">
            <h1>Blood Tests</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Blood tests</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-12">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addNewBloodTest">
                        <i class="fa-solid fa-vial"></i> Add new entry
                    </button>
                </div>
            </div>
        </section>
        <?php include_once __DIR__ . '/../includes/dashboard/modal/add-new-blood-test.php' ?>
        <!-- Page Table -->
        <section class="section pt-3">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">All blood tests</h5>
                            <!-- Table with stripped rows -->
                            <div class="d-flex justify-content-center align-items-center" id="loader">
                                <div class="spinner-border text-primary hide" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <table class="table datatable" id="blood-test-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Test Name</th>
                                        <th>Test Code</th>
                                        <th>Code</th>
                                        <th>Department</th>
                                        <th>Price_rate</th>
                                        <?php
                                        if ($is_super_admin) {
                                        ?>
                                            <th>Sales Rate</th>
                                            <th>Payment</th>
                                        <?php
                                        }
                                        ?>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End of Page Table -->
    </main>

    <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>
    <script type="module" src="assets/js/bloodTest.js"></script>
</body>

</html>