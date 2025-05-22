<?php
session_start();
require_once __DIR__ . '/../connection_string.php';


$fullname = mysqli_real_escape_string($dbcon, $_POST['fullName']);
$username = mysqli_real_escape_string($dbcon, $_POST['username']);
$phone = mysqli_real_escape_string($dbcon, $_POST['phone']);
$password = mysqli_real_escape_string($dbcon, $_POST['password']);
$role = mysqli_real_escape_string($dbcon, $_POST['role']);

$user_id = $_SESSION['user_id'];
$logged_in_user = $_SESSION['name'];

if (empty($fullname) || empty($username) || empty($phone) || empty($password) || empty($role)) {
    echo json_encode(['status' => 'error', 'message' => 'Fields cannot be empty']);
    exit;
}


$sql = "INSERT INTO user(`name`,`phone_number`,`username`,`user_type`,`status`,`created_by`,`modified_by`) VALUES ('{$fullname}','{$phone}','{$username}',$role,1,'{$logged_in_user}','{$logged_in_user}')";
$result = mysqli_query($dbcon, $sql);
if (!$result) {
    echo json_encode(['status' => "error", "message" => "error occurred while adding new user entry"]);
    exit;
}
$new_id = mysqli_insert_id($dbcon);

if ($new_id > 0) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql =  "INSERT INTO user_login(`username`, `password`, `user_id`) VALUES ('{$username}','{$hashed_password}',{$new_id})";
    $result = mysqli_query($dbcon, $sql);

    echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'New staff added successfully' : 'Something went wrong while adding new staff']);
} else {
    echo json_encode(['status' => "error", "message" => "error occurred while adding new user credentials"]);
}
exit;

mysqli_close($dbcon);
