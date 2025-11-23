<?php
include_once __DIR__ . '/../../../models/dashboard/query_helper.php';
?>
<div class="modal fade" id="addPatientBloodTest" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="new-patient-blood-test-form" name="new-patient-blood-test-form">
                <div class="modal-body">

                    <div class="alert alert-danger hide" role="alert" id="new-patient-entry-alert"></div>
                    <div class="row">
                        <div class="col">
                            <!-- Ticket Number -->
                            <div class="mb-3">
                                <label for="ticketNumber" class="form-label">Ticket Number</label>
                                <input type="text" name="ticketNumber" class="form-control" id="ticketNumber" placeholder="123456" required />
                            </div>
                        </div>
                        <div class="col">
                            <!-- Blood Test Name -->
                            <div class="mb-3">
                                <label for="bloodTest" class="form-label">Blood Test</label>
                                <select name="bloodTest" id="bloodTest" class="form-select form-select-md" aria-label="blood-test-name" required>
                                    <option value="" selected>Select Blood Test</option>
                                    <?php
                                    foreach ($all_blood_tests as $test) {
                                    ?> <option value=<?= $test['id'] ?>>
                                            <?= $test['test_name'] ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Row 2 -->
                    <div class="row">
                        <div class="col">
                            <!-- Payment status -->
                            <div class="mb-3">
                                <label for="paymentMode" class="form-label">Payment Mode</label>
                                <select name="paymentMode" id="paymentMode" class="form-select form-select-md" aria-label="blood-test-payment-mode" required>
                                    <option value="" selected>Select payment</option>
                                    <option value="Cash">Cash</option>
                                    <option value="UPI">UPI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input readonly type="number" name="price" class="form-control" id="price" placeholder="0" required />
                            </div>
                        </div>
                    </div>
                    <!-- Row 3 -->

                    <div class="row">
                        <div class="col">
                            <!-- Amount Paid -->
                            <div class="mb-3">
                                <label for="amountPaid" class="form-label">Amount Paid</label>
                                <input type="number" name="amountPaid" class="form-control" id="amountPaid" placeholder="0" required />
                                <span id="amountPaidError" class="error-message"></span>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Due Amount -->
                            <div class="mb-3">
                                <label for="dueAmount" class="form-label">Amount Due</label>
                                <input readonly name="dueAmount" class="form-control" id="dueAmount" placeholder="0" required />
                            </div>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="row">
                        <div class="col">
                            <!-- Discount -->
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount (%)</label>
                                <input type="number" name="discount" class="form-control" id="discount" readonly disabled />
                            </div>
                        </div>
                        <div class="col">
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select form-select-md" aria-label="blood-test-status" required>
                                    <option value="" selected>Select status</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="row">
                        <div class="col">
                            <!-- category -->
                            <!-- <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" name="category" class="form-control" id="category" placeholder="Category" />
                            </div> -->
                        </div>
                        <!-- hidden Field (MRP) -->
                        <div class="col">
                            <div class="mb-3">
                                <input hidden readonly name="mrp" class="form-control" id="mrp" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="Branch">Clinic</label>
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">Select Clinic</option>
                                    <option value="1">Clinic 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-btn">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveEntryButton">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>