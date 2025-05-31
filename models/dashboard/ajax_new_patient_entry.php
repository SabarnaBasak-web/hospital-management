<?php
session_start();
require_once __DIR__ . '/../connection_string.php';

$user_id = $_SESSION['user_id'];

$ticket_number = mysqli_real_escape_string($dbcon, $_POST['ticketNumber']);
$blood_test =  mysqli_real_escape_string($dbcon, $_POST['bloodTest']);
$amount_paid = mysqli_real_escape_string($dbcon, $_POST['amountPaid']);
$amount_due = mysqli_real_escape_string($dbcon, $_POST['dueAmount']);
$discount = mysqli_real_escape_string($dbcon, $_POST['discount']);
$mrp = mysqli_real_escape_string($dbcon, $_POST['mrp']);
$sale_price = mysqli_real_escape_string($dbcon, $_POST['price']);
$category = mysqli_real_escape_string($dbcon, $_POST['category']);
$status = mysqli_real_escape_string($dbcon, $_POST['status']);
$payment_mode = mysqli_real_escape_string($dbcon, $_POST['paymentMode']);
$report_provided = $status === 0 ? date("d-m-y H:i:s") : null;

// Todo: Need to fix this values
$lab_payment = 0;
$branch_code = 1;


$sql_statement = $dbcon->prepare("INSERT INTO patient_blood_test (ticket_number, blood_test_id, category, price, amount_paid, amount_due, discount, status, payment_mode, report_provided, created_by, modified_by,lab_payment, branch_code) VALUES (?, ?, ?,?,?,?,?,?,?,?,?,?,?,?)");

$sql_statement->bind_param('sisiiiisssiiii', $ticket_number, $blood_test, $category, $sale_price, $amount_paid, $amount_due, $discount, $status, $payment_mode, $report_provided, $user_id, $user_id, $lab_payment, $branch_code);

if ($sql_statement->execute()) {
    echo json_encode(['status' => "success", 'message' => "New Record added successfully"]);
} else {
    echo json_encode(['status' => "error", 'message' => $sql_statement->error]);
}


mysqli_close($dbcon);
