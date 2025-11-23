<?php
include_once __DIR__ . '/../models/session_check.php';
include_once __DIR__ . '/../controllers/page-controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . '/../includes/dashboard-header-link.php' ?>
</head>

<body>

    <?php include_once __DIR__ . '/../includes/dashboard-navbar.php' ?>
    <?php include_once __DIR__ . '/../includes/dashboard-sidebar.php' ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <?php include_once __DIR__ . '/../models/dashboard/query_helper.php'; ?>
        <section class="section dashboard">
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">New blood tests <span>| This month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo number_format(htmlspecialchars(getAllPatientEntriesForCurrentMonth())); ?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Completed tests <span>| This Month</span></h5>

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
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Pending tests <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-vial"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo number_format(htmlspecialchars(getPendingTestsForCurrentMonth())); ?></h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->
            </div>


            <div class="row">
                <!-- Daily blood test per clinic -->
                <div class="col-md-4">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Daily Blood test <span>(Per Clinic)</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="ps-3">
                                    <?php
                                    $dailyBloodTests = json_decode(getDailyBloodTestCount(), true);
                                    if (!empty($dailyBloodTests)) {
                                        echo '<small class="text-muted">';
                                        $branches = [];
                                        foreach ($dailyBloodTests as $test) {
                                            $branches[] = 'Branch ' . htmlspecialchars($test['branch_code']) . ': ' . number_format($test['total_count']);
                                        }
                                        echo implode(' | ', $branches);
                                        echo '</small>';
                                    } else {
                                        echo '<h6>0</h6>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End of Daily blood test per clinic -->

                <!-- Daily Amount received per clinic -->
                <div class="col-md-4">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Daily Amount Received <span>(Per Clinic)</span></h5>

                            <div class="d-flex align-items-center">

                                <div class="ps-3">
                                    <?php
                                    $dailyTotalAmount = json_decode(getDailyAmountReceived(), true);
                                    if (!empty($dailyTotalAmount)) {
                                        echo '<small class="text-muted">';
                                        $branches = [];
                                        foreach ($dailyTotalAmount as $test) {
                                            $branches[] = 'Branch ' . htmlspecialchars($test['branch_code']) . ':  &#x20B9;' . number_format($test['total_amount']);
                                        }
                                        echo implode(' | ', $branches);
                                        echo '</small>';
                                    } else {
                                        echo '<h6>0</h6>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End of daily amount received per clinic -->
                <!--Daily Reports provided per clinic  -->
                <div class="col-md-4">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Daily Report Provided <span>(Per Clinic)</span></h5>

                            <div class="d-flex align-items-center">

                                <div class="ps-3">
                                    <?php
                                    $dailyReportProvided = json_decode(getDailyReportProvided(), true);
                                    if (!empty($dailyReportProvided)) {
                                        echo '<small class="text-muted">';
                                        $branches = [];
                                        foreach ($dailyReportProvided as $test) {
                                            $branches[] = 'Branch ' . htmlspecialchars($test['branch_code']) . ': ' . number_format($test['total_count']);
                                        }
                                        echo implode(' | ', $branches);
                                        echo '</small>';
                                    } else {
                                        echo '<h6>0</h6>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End of Daily Reports provided per clinic  -->
            </div>


        </section>

    </main><!-- End #main -->

    <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>


</body>

</html>