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
                                <option value="1">Clinic 1</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="section report-section">
            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Blood test <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-vial-circle-check"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo number_format(htmlspecialchars(getCompletedTestsForCurrentMonth())); ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>


</body>

</html>
</div>
</section>