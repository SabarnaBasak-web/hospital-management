<?php
include_once __DIR__ . '/../../../helpers/util.php';
?>
<!-- Modal for each user -->
<div class="modal fade" id="edit-staff-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="edit_staff_form" name="edit_staff_form">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Update Profile Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger hide" role="alert" id="edit-staff-alert"></div>
                    <div class="row">
                        <input readonly hidden name="user-id" id="user-id" />
                        <div class="col">
                            <div class="mb-3">
                                <label for="full-name">Full Name</label>
                                <input name="full-name" id="full-name" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="edit-username">Username</label>
                                <input name="edit-username" id="edit-username" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="edit-staff-role">Role</label>
                                <select class="form-select form-select-md" name="edit-staff-role" id="edit-staff-role">
                                    <?php foreach ($all_roles as $role) { ?>
                                        <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input name="edit-staff-phone" id="edit-staff-phone" type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select class="form-select form-select-md" name="status" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="edit-staff-btn" name="edit-staff-btn" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal">Close</button>
                </div>
        </form>
    </div>
</div>
<!-- End of Modal -->