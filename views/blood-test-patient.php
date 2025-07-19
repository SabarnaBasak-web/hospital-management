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
    include_once __DIR__ . '/../helpers/util.php';

    $all_blood_tests = getAllBloodTests();
    $all_patients_list = getAllPatientsEntries();
    $is_super_admin = UserRole::isSuperAdmin();
    ?>

    <main id="main" class="main">
        <!-- Title -->
        <div class="pagetitle">
            <h1>Blood test patients list </h1>
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
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addPatientBloodTest" id="add-patient-entry-btn">
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
                            <?php include_once __DIR__ . '/../includes/dashboard/loader.php' ?>
                            <!-- Table with stripped rows -->
                            <table class="table datatable" id="blood-test-patient-list">
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
                                        <?php if ($is_super_admin) {
                                            echo '<th>Lab Payment</th> <th>Payment Status</th>';
                                        }
                                        ?>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End of Page Table -->
        <?php include_once __DIR__ . '/../includes/dashboard/modal/edit-patient-blood-test.php' ?>
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

        // Edit button handler using event delegation
        $(document).on("click", ".edit-icon", function() {
            const id = $(this).find("i[data-id]").attr("data-id");
            const allPatientsList = <?php echo json_encode($all_patients_list); ?>

            const foundPatient = allPatientsList.find(patient => patient.id === id)

            if (foundPatient) {
                const form = $("#edit-patient-blood-test-form");
                form[0].reset();
                const {
                    amount_due,
                    amount_paid,
                    category,
                    discount,
                    id,
                    payment_mode,
                    price,
                    test_name,
                    ticket_number,
                    status
                } = foundPatient
                $("#edit-ticketNumber").val(ticket_number);
                $("#edit-bloodTest").val(test_name)
                $("#edit-category").val(category);
                $("#edit-price").val(price);
                $("#previous-payment").val(amount_paid);
                $("#edit-dueAmount").val(amount_due);
                $("#edit-discount").val(discount);
                $("#edit-paymentMode").val(payment_mode);
                $('#edit-id').val(id)
                $('#edit-status').val(status);
            }

            $('#editPatientBloodTest').modal('show');
        });
    </script>
</body>

</html>