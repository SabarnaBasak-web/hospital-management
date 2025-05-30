<?php
include_once __DIR__ . '/../../models/dashboard/query_helper.php';
$all_staff = getAllStaff();
?>

<div class="tab-pane fade pt-3" id="profile-settings">



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
                <form id="edit_staff_form" name="edit_staff_form">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">Profile Details</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                        <div class="col-lg-9 col-md-8">
                          <input type="text" name="id" id="id" value="<?= $all_staff_value['user_id'] ?>" />
                          <input name="full-name" type="text" class="form-control" value="<?= htmlspecialchars($all_staff_value['name']) ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Role</div>
                        <div class="col-lg-9 col-md-8">
                          <select class="form-select form-select-sm" name="role" id="role">
                            <option selected><?= $all_staff_value['role_name'] ?></option>
                            <?php foreach ($all_roles as $role) { ?>
                              <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Phone</div>
                        <div class="col-lg-9 col-md-8">
                          <input name="phone" type="text" class="form-control" value="<?= htmlspecialchars($all_staff_value['phone_number']) ?>" required>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Status</div>
                        <div class="col-lg-9 col-md-8">
                          <select class="form-select form-select-sm" name="status" id="status">
                            <option value="1" <?= $all_staff_value['status'] == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $all_staff_value['status'] == 0 ? 'selected' : '' ?>>Deactive</option>
                          </select>
                        </div>
                      </div>

                      <br>
                      <div class="text-center">
                        <button type="submit" id="edit-staff-btn" name=edit-staff-btn" class="btn btn-primary">Update User</button>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

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


  <!--The Modal end modal  -->


  <!-- include_once __DIR__ . ' '/modal/edit-staff-modal.php' ?> -->