<?php
include_once __DIR__ . '/../../../models/dashboard/query_helper.php';

$all_blood_departments = getBloodDepartments();

?>
<div class="modal fade" id="editBloodTest" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Blood Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-blood-test-form" name="edit-blood-test-form">
                <div class="modal-body">
                    <div class="alert alert-danger hide" role="alert" id="custom-alert"></div>

                    <input type="hidden" name="edit-id" id="edit-id" />
                    <div class="mb-3">
                        <label for="testName" class="form-label">Test Name</label>
                        <input type="text" name="edit-testName" class="form-control" id="edit-testName" />
                    </div>
                    <div class="mb-3">
                        <label for="testCode" class="form-label">Test Code</label>
                        <input type="text" name="edit-testCode" class="form-control" id="edit-testCode" />
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" name="edit-code" class="form-control" id="edit-code" />
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select name="edit-department" id="edit-department" class="form-select form-select-sm" aria-label="blood-test-department">
                            <option selected>Select department</option>
                            <?php
                            foreach ($all_blood_departments as $dept) {
                            ?> <option value=<?= $dept['id'] ?>>
                                    <?= $dept['name'] ?>
                                </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mrp" class="form-label">MRP</label>
                        <input type="number" name="edit-mrp" class="form-control" id="edit-mrp" />
                    </div>
                    <div class="mb-3">
                        <label for="saleRate" class="form-label">Sale Rate</label>
                        <input type="number" name="edit-saleRate" class="form-control" id="edit-saleRate" />
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment</label>
                        <input type="number" name="edit-payment" class="form-control" id="edit-payment" />
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-btn">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateBloodTestDetails">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>