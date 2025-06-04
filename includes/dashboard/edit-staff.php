<?php
include_once __DIR__ . '/../../models/dashboard/query_helper.php';
$all_staff = getAllStaff();
?>

<div class="tab-pane fade pt-3" id="edit-staff">
  <div class="card">
    <div class="card-body">
      <table class="datatable">
        <thead>
          <tr>
            <th><b>N</b>ame</th>
            <th>Role</th>
            <th>Phone</th>
            <th>active/<br>deactive</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($all_staff as $field => $all_staff_value) { ?>
            <tr>
              <td><?= $all_staff_value['name'] ?></td>
              <td><?= $all_staff_value['role_name'] ?></td>
              <td><?= $all_staff_value['user_id'] ?></td>
              <td>
                <?php if ($all_staff_value['status'] == 1) { ?>
                  <span class="text-success small pt-1 fw-bold"> Active </span>
                <?php } else { ?>
                  <span class="text-danger small pt-1 fw-bold"> Deactive </span>
                <?php } ?>
              </td>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal-<?= $all_staff_value['user_id'] ?>">
                  <i class="bi bi-gear-fill"></i>
                </button>
              </td>
            </tr>


            <!-- Modal for each user -->
            <div class="modal fade" id="myModal-<?= $all_staff_value['user_id'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <form id="edit_staff_form-<?= $all_staff_value['user_id'] ?>" name="edit_staff_form-<?= $all_staff_value['user_id'] ?>">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">Update Profile Details</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                      <div class="row">
                        <input readonly hidden name="user-id-<?= $all_staff_value['user_id'] ?>" id="user-id-<?= $all_staff_value['user_id'] ?>" value="<?= $all_staff_value['user_id'] ?>" />
                        <div class="col">
                          <div class="mb-3">
                            <label for="full-name--<?= $all_staff_value['user_id'] ?>">Full Name</label>
                            <input name="full-name--<?= $all_staff_value['user_id'] ?>" id="full-name--<?= $all_staff_value['user_id'] ?>" type="text" class="form-control" value="<?= htmlspecialchars($all_staff_value['name']) ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                            <label for="edit-staff-role-<?= $all_staff_value['user_id'] ?>">Role</label>
                            <select class="form-select form-select-md" name="edit-staff-role-<?= $all_staff_value['user_id'] ?>" id="edit-staff-role-<?= $all_staff_value['user_id'] ?>">
                              <option selected><?= $all_staff_value['role_name'] ?></option>
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
                            <label for="phone-<?= $all_staff_value['user_id'] ?>">Phone</label>
                            <input name="phone-<?= $all_staff_value['user_id'] ?>" id="phone-<?= $all_staff_value['user_id'] ?>" type="number" class="form-control" value="<?= htmlspecialchars($all_staff_value['phone_number']) ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col">
                          <div class="mb-3">
                            <label for="status-<?= $all_staff_value['user_id'] ?>">Status</label>
                            <select class="form-select form-select-md" name="status-<?= $all_staff_value['user_id'] ?>" id="status-<?= $all_staff_value['user_id'] ?>">
                              <option value="1" <?= $all_staff_value['status'] == 1 ? 'selected' : '' ?>>Active</option>
                              <option value="0" <?= $all_staff_value['status'] == 0 ? 'selected' : '' ?>>Deactive</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" id="edit-staff-btn-<?= $all_staff_value['user_id'] ?>" name="edit-staff-btn-<?= $all_staff_value['user_id'] ?>" class="btn btn-primary">Update User</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
              </div>
            </div>
            <!-- End of Modal -->
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--The Modal end modal  -->