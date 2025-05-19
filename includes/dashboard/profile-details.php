<?php
include_once __DIR__ . '/../../models/dashboard/query_helper.php';
$user_details = getCurrentUserDetails();
?>
<div class="tab-pane fade show active profile-overview" id="profile-overview">

    <h5 class="card-title">Profile Details</h5>

    <div class="row">
        <div class="col-lg-3 col-md-4 label ">Full Name</div>
        <div class="col-lg-9 col-md-8"><?= $user_details['name'] ?></div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Role</div>
        <div class="col-lg-9 col-md-8"><?= $user_details['role_name'] ?></div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4 label">Phone</div>
        <div class="col-lg-9 col-md-8"><?= $user_details['phone_number'] ?></div>
    </div>


</div>