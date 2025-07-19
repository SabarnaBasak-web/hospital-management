<?php
session_start();
require_once __DIR__ . '/../connection_string.php';



$row_id = mysqli_real_escape_string($dbcon, $_POST['edit-id']);
$test_name = mysqli_real_escape_string($dbcon, $_POST['edit-testName']);
$test_code = mysqli_real_escape_string($dbcon, $_POST['edit-testCode']);
$code = mysqli_real_escape_string($dbcon, $_POST['edit-code']);
$department = mysqli_real_escape_string($dbcon, $_POST['edit-department']);
$sale_rate = mysqli_real_escape_string($dbcon, $_POST['edit-saleRate']);
$mrp = mysqli_real_escape_string($dbcon, $_POST['edit-mrp']);
$payment = mysqli_real_escape_string($dbcon, $_POST['edit-payment']);

$curr_user_name = $_SESSION['name'];





$sql_statement = $dbcon->prepare("UPDATE blood_tests SET test_name=?, test_code=?,code=?,price_rate=?, sale_rate=?, department_id=?, payment=?, modified_by=? WHERE id=?");

$sql_statement->bind_param('sssiisiss', $test_name, $test_code, $code, $mrp, $sale_rate, $department, $payment, $curr_user_name,  $row_id);

if ($sql_statement->execute()) {
    echo json_encode(['status' => "success", "message" => "Successfully added new blood test"]);
} else {
    echo json_encode(['status' => "error", "message" => "Something went wrong while creating new entry"]);
}
exit;


mysqli_close($dbcon);
