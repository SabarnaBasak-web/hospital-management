<?php
include_once __DIR__ . '/../../../models/dashboard/query_helper.php';

$all_blood_departments = getBloodDepartments();

?>
<div class="modal fade" id="addNewBloodTest" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Blood Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="new-blood-test-form" name="new-blood-test-form">
                <div class="modal-body">
                    <div class="alert alert-danger hide" role="alert" id="custom-alert"></div>
                    <div class="mb-3">
                        <label for="testName" class="form-label">Test Name</label>
                        <input type="text" name="testName" class="form-control" id="testName" placeholder="Albumin" required />
                    </div>
                    <div class="mb-3">
                        <label for="testCode" class="form-label">Test Code</label>
                        <input type="text" name="testCode" class="form-control" id="testCode" placeholder="LSHH18182" required />
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="BC302" required />
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select name="department" id="department" class="form-select form-select-sm" aria-label="blood-test-department">
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
                        <input type="number" name="mrp" class="form-control" id="mrp" placeholder="1000" required />
                    </div>
                    <div class="mb-3">
                        <label for="saleRate" class="form-label">Sale Rate</label>
                        <input type="number" name="saleRate" class="form-control" id="saleRate" placeholder="1000" required />
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-btn">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveNewTest">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>