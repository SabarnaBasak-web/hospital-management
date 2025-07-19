<?php
session_start();
require_once __DIR__ . '/../connection_string.php';

$user_id = $_SESSION['user_id'];

$id = mysqli_real_escape_string($dbcon, $_POST['edit-id']);
$previous_amt = mysqli_real_escape_string($dbcon, $_POST['previous-payment']);
$amount_paid = mysqli_real_escape_string($dbcon, $_POST['edit-amountPaid']);
$amount_due = mysqli_real_escape_string($dbcon, $_POST['edit-dueAmount']);
$status = mysqli_real_escape_string($dbcon, $_POST['edit-status']);
$payment_mode = mysqli_real_escape_string($dbcon, $_POST['edit-paymentMode']);

// Todo: Need to fix this values
$lab_payment = 0;
$branch_code = 1;

$total_amount_paid = ((int)$amount_paid + (int)$previous_amt);


$sql_statement = $dbcon->prepare("UPDATE patient_blood_test SET amount_paid=?, amount_due=?,status=?,payment_mode=? WHERE id=?");

$sql_statement->bind_param('iissi', $total_amount_paid, $amount_due, $status, $payment_mode, $id);

if ($sql_statement->execute()) {
    echo json_encode(['status' => "success", 'message' => "Record updated successfully"]);
} else {
    echo json_encode(['status' => "error", 'message' => $sql_statement->error]);
}


mysqli_close($dbcon);
