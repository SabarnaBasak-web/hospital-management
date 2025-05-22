<?php
session_start();
require_once __DIR__ . '/../connection_string.php';


$fullName = $_POST['fullName'];
$username =  $_POST['username'];
$Phone = $post['Phone'];
$password = mysqli_real_escape_string($dbcon, $_POST['password']);
$role = $post['role'];


if (empty($fullName) || empty($username) || empty($Phone) || empty($password) || empty($role)) {
    echo json_encode(['status' => 'error', 'message' => 'Fields cannot be empty']);
    exit;
}


// add_staff
echo ""INSERT INTO `user_login`(`id`, `username`, `password`, `user_id`) 
                        VALUES ('[value-1]','$username','$password','1')";die;


// $result = mysqli_query($dbcon, $sql_add_staff);

// echo $result;die;
// echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Password updated successfully!' : 'Something went wrong while updating password']);

// mysqli_close($dbcon);
