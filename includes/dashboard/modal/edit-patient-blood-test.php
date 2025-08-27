<?php
include_once __DIR__ . '/../../../models/dashboard/query_helper.php';
?>
<div class="modal fade" id="editPatientBloodTest" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-patient-blood-test-form" name="edit-patient-blood-test-form">
                <div class="modal-body">

                    <div class="alert alert-danger hide" role="alert" id="edit-patient-entry-alert"></div>
                    <div class="row">
                        <div class="col">

                            <!-- Ticket Number -->
                            <div class="mb-3">
                                <label for="ticketNumber" class="form-label">Ticket Number</label>
                                <input type="text" name="edit-ticketNumber" class="form-control" id="edit-ticketNumber" placeholder="123456" disabled />
                            </div>
                        </div>
                        <div class="col">
                            <!-- Blood Test Name -->
                            <div class="mb-3">
                                <label for="bloodTest" class="form-label">Blood Test</label>
                                <input type="text" name="edit-bloodTest" id="edit-bloodTest" class="form-control" disabled />

                            </div>
                        </div>
                    </div>
                    <!-- Row 2 -->
                    <div class="row">
                        <div class="col">
                            <!-- Payment Mode -->
                            <div class="mb-3">
                                <label for="paymentMode" class="form-label">Payment Mode</label>
                                <select name="edit-paymentMode" id="edit-paymentMode" class="form-select form-select-md" aria-label="blood-test-payment-mode">
                                    <option selected>Select payment</option>
                                    <option value="Cash">Cash</option>
                                    <option value="UPI">UPI</option>
                                </select>

                            </div>
                        </div>
                        <div class="col">
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input readonly type="number" name="edit-price" class="form-control" id="edit-price" disabled />
                            </div>
                        </div>
                    </div>


                    <!-- Row 2.5 -->
                    <div class="row">
                        <div class="col">
                            <!-- Previous Payment -->
                            <div class="mb-3">
                                <label for="amountPaid" class="form-label">Previous payment</label>
                                <input type="number" class="form-control" readonly name="previous-payment" id="previous-payment">
                            </div>

                        </div>
                        <div class="col">
                            <!-- Amount Paid -->
                            <div class="mb-3">
                                <label for="amountPaid" class="form-label">Amount Paid</label>
                                <input type="number" name="edit-amountPaid" class="form-control" id="edit-amountPaid" placeholder="0" required />
                                <span id="edit-amountPaidError" class="error-message"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class=" row">
                        <div class="col">
                            <!-- Due Amount -->
                            <div class="mb-3">
                                <label for="dueAmount" class="form-label">Amount Due</label>
                                <input readonly name="edit-dueAmount" class="form-control" id="edit-dueAmount" />
                            </div>
                        </div>
                        <div class="col">
                            <!-- Discount -->
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount (%)</label>
                                <input name="edit-discount" class="form-control" id="edit-discount" placeholder="50" required disabled />
                            </div>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="row">
                        <div class="col">
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Report status</label>
                                <select name="edit-status" id="edit-status" class="form-select form-select-md" aria-label="blood-test-status">
                                    <option selected>Select status</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="row">
                        <div class="col">
                            <!-- Category -->
                            <!-- <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" name="edit-category" class="form-control" id="edit-category" placeholder="Category" disabled />
                            </div> -->
                            <div class="mb-3">
                                <input type="hidden" name="edit-id" id='edit-id' />
                            </div>
                        </div>
                        <!-- hidden Field (MRP) -->
                        <div class="col">
                            <div class="mb-3">
                                <input hidden readonly name="mrp" class="form-control" id="mrp" />
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-btn">Close</button>
                    <button type="submit" class="btn btn-primary" id="updateButton">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>