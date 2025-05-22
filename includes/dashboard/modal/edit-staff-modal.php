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
                

                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">
                        <input name="fullName" type="text" class="form-control" id="fullName" value=" <?= $user_details['name'] ?>" required>
                    </div>
                </div>
<br>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Role</div>
                    <div class="col-lg-9 col-md-8">
                            <select class="form-select form-select-sm" aria-label="Small select example">
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
                        <select class="form-select form-select-sm" aria-label="Small select example">
                                <option selected><?php if($user_details['status'] ==1){?> <span class="text-success small pt-1 fw-bold"> Active </span><?php } else { ?><span class="text-danger small pt-1 fw-bold"> Deactive </span> <?php } ?></option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                        </select>
                   </div>
                </div>
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