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

$report_provided = null;
if ($status == 'completed' && $amount_due == 0) {
    $report_provided = date('Y-m-d');
}

$modified_date = date('Y-m-d H:i:s');


$sql = "SELECT ticket_number from patient_blood_test WHERE id=" . $id;
$result = mysqli_query($dbcon, $sql);
$row = mysqli_fetch_assoc($result);
$ticket_number = $row['ticket_number'];


$sql_statement = $dbcon->prepare("UPDATE patient_blood_test SET amount_paid=?, total_amount_paid=?, amount_due=?,status=?,payment_mode=?, report_provided=?, modified_date=? WHERE id=?");
$sql_statement->bind_param('iiissssi', $amount_paid, $total_amount_paid, $amount_due, $status, $payment_mode, $report_provided, $modified_date, $id);


$sql_statement2 = $dbcon->prepare("INSERT INTO payments(ticket_number,amount,payment_type,branch_code) VALUES(?,?,?,?)");
$sql_statement2->bind_param('iiss', $ticket_number, $amount_paid, $payment_mode, $branch_code);

if ($sql_statement->execute() && $sql_statement2->execute()) {
    echo json_encode(['status' => "success", 'message' => "Record updated successfully"]);
} else {
    echo json_encode(['status' => "error", 'message' => $sql_statement->error]);
}


mysqli_close($dbcon);
