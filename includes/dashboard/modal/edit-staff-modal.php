<!-- The Modal start -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Profile Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body show Profile Details-->
      <div class="modal-body">

        <form id="edit_staff_form" name="edit_staff_form">
          <div class="row">
            <div class="col-lg-3 col-md-4 label ">Full Name</div>
            <div class="col-lg-9 col-md-8">
              <input name="id" type="text" class="form-control" id="id" value=" <?= $user_details['id'] ?>" required>
              <input name="fullname" type="text" class="form-control" id="fullname" value=" <?= $user_details['name'] ?>" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-3 col-md-4 label ">Username</div>
            <div class="col-lg-9 col-md-8">
              <input name="username" type="text" class="form-control" id="username" value=" <?= $user_details['username'] ?>" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-3 col-md-4 label">Role</div>
            <div class="col-lg-9 col-md-8">
              <select class="form-select form-select-sm" aria-label="Small select example" name="role" id="role">
                <option selected><?= $user_details['role_name'] ?></option>
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
          <br>
          <div class="row">
            <div class="col-lg-3 col-md-4 label">Phone</div>
            <div class="col-lg-9 col-md-8">
              <input name="phone" type="text" class="form-control" id="Phone" value="<?= $user_details['phone_number'] ?>" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-3 col-md-4 label">status</div>
            <div class="col-lg-9 col-md-8">
              <select class="form-select form-select-sm" aria-label="Small select example" name="status" id="status">



                <option value="1" <?php echo ($user_details['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?php echo ($user_details['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>

              </select>
            </div>
          </div>
          <br>
          <div class="text-center">
            <button type="submit" id="edit-staff-btn" name="edit-staff-btn" class="btn btn-primary">save</button>
          </div>
        </form>

      </div>
      <!-- End Modal body show Profile Details-->
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--The Modal end modal  -->