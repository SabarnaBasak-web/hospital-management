<?php
include_once __DIR__ . '/../models/session_check.php';
include_once __DIR__ . '/../controllers/page-controller.php';
include_once __DIR__ . '/../helpers/util.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once __DIR__ . '/../includes/dashboard-header-link.php' ?>
  <link rel="stylesheet" type="text/css" href="assets/css/manage-profile.css" />
</head>

<body>

  <?php
  include_once __DIR__ . '/../includes/dashboard-navbar.php';
  include_once __DIR__ . '/../includes/dashboard-sidebar.php';

  include_once __DIR__ . '/../models/dashboard/query_helper.php';
  $all_staff = getAllStaff();
  $is_super_admin = isSuperAdmin();
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?= $_SESSION['name'] ?></h2>
              <h3><?= $_SESSION['role'] ?></h3>

            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>
                <?php if ($is_super_admin) { ?>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#add-staff">Add Staff</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#edit-staff">Edit Staff</button>
                  </li>
                <?php } ?>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">
                <?php include_once __DIR__ . '/../includes/dashboard/profile-details.php' ?>
                <?php include_once __DIR__ . '/../includes/dashboard/add-staff.php' ?>
                <?php include_once __DIR__ . '/../includes/dashboard/edit-staff.php' ?>
                <?php include_once __DIR__ . '/../includes/dashboard/change-password.php' ?>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include_once __DIR__ . '/../includes/dashboard-footer.php' ?>
  <!-- Template Main JS File -->
  <script type="module" src="assets/js/manageProfile.js"></script>

  <script type="text/javascript">
    const allStaffs = <?php echo json_encode($all_staff); ?>;

    $(".action").on("click", function() {
      const rowId = $(this).data('selected-id');
      const selectedStaffDetails = allStaffs.find(staff => staff.id === rowId.toString());
      console.log('@@ selectedStaffDetails', selectedStaffDetails)
      $('#full-name').val(selectedStaffDetails.name)
      $('#edit-staff-role').val(selectedStaffDetails['role_id']).trigger('change')
      $("#edit-staff-phone").val(selectedStaffDetails['phone_number'])
      $("#status").val(selectedStaffDetails.status).trigger('change')
      $("#user-id").val(selectedStaffDetails.id)
      $('#edit-username').val(selectedStaffDetails.username)
    });
  </script>

</body>

</html>