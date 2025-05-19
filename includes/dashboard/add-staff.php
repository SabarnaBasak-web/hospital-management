<?php
include_once __DIR__ . '/../../models/dashboard/query_helper.php';

$all_roles = getUserRoles();

?>
<div class="tab-pane fade profile-edit pt-3" id="profile-edit">
    <!-- Profile Edit Form -->
    <form id="add-staff" name="add-staff">
        <div class="row mb-3">
            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
            <div class="col-md-8 col-lg-9">
                <input name="fullName" type="text" class="form-control" id="fullName" placeholder="John Doe" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
            <div class="col-md-8 col-lg-9">
                <input name="phone" type="text" class="form-control" id="Phone" placeholder="+91 1234567890" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="Email" class="col-md-4 col-lg-3 col-form-label">User Role</label>
            <div class="col-md-8 col-lg-9">
                <select class="form-select form-select-sm" aria-label="Small select example">
                    <option selected>Open this select menu</option>
                    <?php
                    foreach ($all_roles as $role) {
                    ?> <option value=<?= $role['id'] ?>>
                            <?= $role['role_name'] ?>
                        </option>
                    <?php }
                    ?>
                </select>

            </div>
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form><!-- End Profile Edit Form -->

</div>