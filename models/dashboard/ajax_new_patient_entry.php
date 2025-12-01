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
$status = mysqli_real_escape_string($dbcon, $_POST['status']);
$payment_mode = mysqli_real_escape_string($dbcon, $_POST['paymentMode']);
$report_provided = $status === 0 ? date("d-m-y H:i:s") : null;
$branch_code = mysqli_real_escape_string($dbcon, $_POST['branch']);

// Validate all required fields
if (empty($ticket_number) || $ticket_number <= 0) {
    echo json_encode(['status' => "error", 'message' => "Ticket number is required"]);
    exit;
}

if (empty($blood_test)) {
    echo json_encode(['status' => "error", 'message' => "Blood test is required"]);
    exit;
}

if ($amount_paid == '' || !is_numeric($amount_paid) || $amount_paid < 0) {
    echo json_encode(['status' => "error", 'message' => "Amount paid is required"]);
    exit;
}

if ($amount_due == '' || !is_numeric($amount_due) || $amount_due < 0) {
    echo json_encode(['status' => "error", 'message' => "Due amount is required" . $amount_due]);
    exit;
}

if (empty($discount)) {
    echo json_encode(['status' => "error", 'message' => "Discount is required"]);
    exit;
}

if (empty($mrp)) {
    echo json_encode(['status' => "error", 'message' => "MRP is required"]);
    exit;
}

if ($sale_price == '' || !is_numeric($sale_price) || $sale_price < 0) {
    echo json_encode(['status' => "error", 'message' => "Sale price is required"]);
    exit;
}

if (empty($status)) {
    echo json_encode(['status' => "error", 'message' => "Status is required"]);
    exit;
}

if (empty($payment_mode)) {
    echo json_encode(['status' => "error", 'message' => "Payment mode is required"]);
    exit;
}


if ($status == 'completed' && $amount_due > 0) {
    echo json_encode(['status' => "error", 'message' => "Cannot put status as completed when amount due is pending"]);
    exit;
}

// Todo: Need to fix this values
$lab_payment = 0;
$category = '';

$sql_statement = $dbcon->prepare("INSERT INTO patient_blood_test (ticket_number, blood_test_id,category, price, amount_paid, total_amount_paid, amount_due, discount, status, payment_mode, report_provided, created_by, modified_by,lab_payment, branch_code) VALUES (?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?)");

$sql_statement->bind_param('sisiiiiisssiiii', $ticket_number, $blood_test, $category, $sale_price, $amount_paid, $amount_paid, $amount_due, $discount, $status, $payment_mode, $report_provided, $user_id, $user_id, $lab_payment, $branch_code);


$sql_statement2 = $dbcon->prepare("INSERT INTO payments(ticket_number,amount,payment_type, branch_code) VALUES(?,?,?,?)");
$sql_statement2->bind_param('iiss', $ticket_number, $amount_paid, $payment_mode, $branch_code);

if ($sql_statement->execute() && $sql_statement2->execute()) {
    echo json_encode(['status' => "success", 'message' => "New Record added successfully"]);
} else {
    echo json_encode(['status' => "error", 'message' => $sql_statement->error]);
}

mysqli_close($dbcon);
