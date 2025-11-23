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
    <link rel='stylesheet' type='text/css' href="assets/css/blood-test.css" />
    <link rel='stylesheet' type='text/css' href="assets/css/table-search.css" />
</head>

<body>

    <?php include_once __DIR__ . '/../includes/dashboard-navbar.php' ?>
    <?php include_once __DIR__ . '/../includes/dashboard-sidebar.php' ?>
    <?php include_once __DIR__ . '/../models/dashboard/query_helper.php' ?>

    <?php $all_blood_tests = getAllBloodTests(); ?>
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
                            <?php include_once __DIR__ . '/../includes/dashboard/loader.php' ?>
                            <table class="table datatable" id="blood-test-table">
                                <?php include_once __DIR__ . '/../includes/dashboard/table-search-field.php' ?>
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
                                <tbody id="blood-test-table-body"></tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End of Page Table -->

        <?php include_once __DIR__ . '/../includes/dashboard/modal/edit-blood-test.php' ?>
    </main>

    <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>
    <script type="module" src="assets/js/bloodTest.js"></script>

    <script defer>
        $(document).on('click', '.edit-BloodTest', function() {
            const allBloodTests = <?php echo json_encode($all_blood_tests) ?>

            const selectedId = $(this).attr("data-id");

            const selectedDetails = allBloodTests.find(bloodtest => bloodtest.id === selectedId);

            const {
                id,
                test_name,
                test_code,
                code,
                price_rate,
                sale_rate,
                payment,
                department_id
            } = selectedDetails;

            $("#edit-id").val(id)
            $("#edit-testName").val(test_name)
            $("#edit-testCode").val(test_code)
            $("#edit-code").val(code)
            $("#edit-department").val(department_id)
            $("#edit-mrp").val(price_rate)
            $("#edit-saleRate").val(sale_rate)
            $("#edit-payment").val(payment)
        });
    </script>
</body>

</html>