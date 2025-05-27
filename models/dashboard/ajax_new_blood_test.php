<?php
session_start();
require_once __DIR__ . '/../connection_string.php';



$test_name = mysqli_real_escape_string($dbcon, $_POST['testName']);
$test_code = mysqli_real_escape_string($dbcon, $_POST['testCode']);
$code = mysqli_real_escape_string($dbcon, $_POST['code']);
$department = mysqli_real_escape_string($dbcon, $_POST['department']);
$sale_rate = mysqli_real_escape_string($dbcon, $_POST['saleRate']);
$mrp = mysqli_real_escape_string($dbcon, $_POST['mrp']);

$curr_user_name = $_SESSION['name'];


$sql = "INSERT INTO blood_tests (`test_name`, `test_code`, `code`, `price_rate`, `sale_rate`, `department_id`, `payment`, `created_by`, `modified_by`) VALUES ('{$test_name}','{$test_code}','{$code}',$mrp,$sale_rate,$department,0,'{$curr_user_name}','{$curr_user_name}')";
$result = mysqli_query($dbcon, $sql);

if ($result) {
    echo json_encode(['status' => "success", "message" => "Successfully added new blood test"]);
} else {
    echo json_encode(['status' => "error", "message" => "Something went wrong while creating new entry"]);
}
exit;


mysqli_close($dbcon);
