<?php
include_once __DIR__ . '/../../models/dashboard/query_helper.php';
$user_details = getCurrentUserDetails();
?>

<div class="tab-pane fade pt-3" id="profile-settings">







<!-- Settings Form -->
<form>

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
<tr>
  <td><?= $user_details['name'] ?></td>
  <td><?= $user_details['role_name'] ?></td>
  <td><?= $user_details['phone_number'] ?></td>
  <!-- <td><input class="form-check-input" type="checkbox" id="changesMade" checked></td> -->
   <td><?php if($user_details['status'] ==1){?> <span class="text-success small pt-1 fw-bold"> Active </span><?php } else { ?><span class="text-danger small pt-1 fw-bold"> Deactive </span> <?php } ?></td>
   <!-- <td><a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-gear-fill"></i></a></td> -->
   <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-gear-fill"></i></button></td>
</tr>

</tbody>
</table>
<!-- End Table with stripped rows -->

</div>
</div>
 
</form><!-- End settings Form -->

</div>

<!-- The Modal -->
 <?php include_once __DIR__ . '/modal/edit-staff-modal.php' ?>

<!-- end The Modal -->