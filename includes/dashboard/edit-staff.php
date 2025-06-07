<?php
include_once __DIR__ . '/../../models/dashboard/query_helper.php';

$all_staff = getAllStaff();
?>

<div class="tab-pane fade pt-3" id="edit-staff">

  <table class="datatable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($all_staff as $field => $all_staff_value) { ?>
        <tr>
          <td><?= $all_staff_value['name'] ?></td>
          <td><?= $all_staff_value['role_name'] ?></td>

          <td>
            <i class="bi <?= $all_staff_value['status'] == 1 ? 'bi-check-circle-fill fs-4 text-success' : 'bi-x-circle-fill text-danger' ?>"></i>
          </td>
          <td>
            <i class="action fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#edit-staff-modal" data-selected-id="<?= htmlspecialchars($all_staff_value['id']) ?>"></i>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</div>
<?php include_once __DIR__ . '/../dashboard/modal/edit-staff-modal.php' ?>

<!--The Modal end modal  -->