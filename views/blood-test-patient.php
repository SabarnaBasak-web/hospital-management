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

    <?php
    include_once __DIR__ . '/../includes/dashboard-navbar.php';
    include_once __DIR__ . '/../includes/dashboard-sidebar.php';
    $all_blood_tests = getAllBloodTests();
    $all_patients_list = getAllPatientsEntriesByDate();
    ?>

    <main id="main" class="main">
        <!-- Title -->
        <div class="pagetitle">
            <h1>Blood test patients list</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Blood tests patients list</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-12">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addPatientBloodTest">
                        <i class="fa-solid fa-hospital-user"></i> Add today's patients list
                    </button>
                </div>
            </div>
        </section>
        <?php include_once __DIR__ . '/../includes/dashboard/modal/new-patient-blood-test.php' ?>


        <!-- Page Table -->
        <section class="section pt-3">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daily Patients List</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Ticket Number</th>
                                        <th>Blood Test</th>
                                        <th>Category</th>
                                        <th>Price(&#x20B9;) </th>
                                        <th>Amount Paid(&#x20B9;) </th>
                                        <th>Amount Due(&#x20B9;) </th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Payment Mode</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($all_patients_list as $field => $field_value) {
                                    ?>
                                        <tr>
                                            <td><?= $field_value['id'] ?></td>
                                            <td><?= $field_value['ticket_number'] ?></td>
                                            <td><?= $field_value['test_name'] ?></td>
                                            <td><?= $field_value['category'] ?></td>
                                            <td><?= $field_value['price'] ?></td>
                                            <td><?= $field_value['amount_paid'] ?></td>
                                            <td><?= $field_value['amount_due'] ?></td>
                                            <td><?= $field_value['discount'] ?> %</td>
                                            <td><?= $field_value['status'] ?></td>
                                            <td><?= $field_value['payment_mode'] ?></td>
                                            <td class="text-center"><button class="btn"><i class="fa-solid fa-pen"></i></button></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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
    <script type="module" src="assets/js/patientEntry.js"></script>


    <script defer>
        const allBloodTests = <?php echo json_encode($all_blood_tests); ?>;
        const mappedMrp = allBloodTests.reduce((acc, curr) => {
            const {
                id,
                price_rate,
                sale_rate,
            } = curr;
            acc[id] = {
                mrp: price_rate,
                saleRate: sale_rate
            };
            return acc;
        }, {});


        $("#bloodTest").on("change", function() {
            const selectedValue = $(this).val();
            const {
                mrp,
                saleRate
            } = mappedMrp[selectedValue];

            $('#mrp').val(mrp);
            $('#price').val(saleRate);

            const discountPercent = ((mrp - saleRate) / mrp) * 100;
            $("#discount").removeAttr('disabled').val(discountPercent)
        });
    </script>
</body>

</html>