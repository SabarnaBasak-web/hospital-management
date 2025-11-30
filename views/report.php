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
    <link rel='stylesheet' type='text/css' href="assets/css/report.css" />

</head>

<body>

    <?php include_once __DIR__ . '/../includes/dashboard-navbar.php' ?>
    <?php include_once __DIR__ . '/../includes/dashboard-sidebar.php' ?>
    <?php include_once __DIR__ . '/../models/dashboard/query_helper.php' ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Reports</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <!-- Clinic Selection -->
            <div class="row">
                <div class="col-lg-2">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="clinic">Clinic</label>
                            <select name="clinic" id="clinic" class="form-control">
                                <option value="">Select Clinic</option>
                                <option value="1" selected>Clinic 1</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="section report-section">

            <h6>Daily</h6>
            <div class="row">
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Blood tests </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-vial-circle-check"></i>
                                </div>
                                <div class="ps-3 mt-2">
                                    <h6 id="bloodTestCountText">0</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Reports Provided </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <div class="ps-3 mt-2">
                                    <h6 id="reportProvidedText">0</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Amount Received </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-money-bills"></i>
                                </div>
                                <div class="ps-3 mt-2">
                                    <h6 id="amountReceivedText">0</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <h6>Monthly</h6>
            <div class="row">
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Blood tests</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-vial-circle-check"></i>
                                </div>
                                <div class="ps-3 mt-2">
                                    <h6 id="monthlyBloodTestCountText">0</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Reports Provided </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <div class="ps-3 mt-2">
                                    <h6 id="monthlyReportProvidedText">0</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-4">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Amount Received</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-money-bills"></i>
                                </div>
                                <div class="ps-3 mt-2">
                                    <h6 id="monthlyAmountReceivedText">0</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>
    <script type="module" src="assets/js/reports.js"></script>


</body>

</html>
</div>
</section>