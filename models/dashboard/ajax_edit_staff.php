<?php
session_start();
require_once __DIR__ . '/../connection_string.php';

$id = mysqli_real_escape_string($dbcon, $_POST['id']);
$fullname = mysqli_real_escape_string($dbcon, $_POST['fullname']);
$username = mysqli_real_escape_string($dbcon, $_POST['username']);
$role = mysqli_real_escape_string($dbcon, $_POST['role']);
$phone = mysqli_real_escape_string($dbcon, $_POST['phone']);
$status = mysqli_real_escape_string($dbcon, $_POST['status']);

if (empty($fullname) || empty($username) || empty($role) || empty($phone) || empty($status)) {
    echo json_encode(['status' => 'error', 'message' => 'Fields cannot be empty']);
    exit;
}




// Update the existing password
//$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
// echo "UPDATE `user` SET `name`='$fullname',`phone_number`='$phone',`username`='$username',
// -- `user_type`='$role',`status`='$status'WHERE `id`='$id'";die;

$sql = "UPDATE user SET name='{$fullname}',phone_number='{$phone}',username='{$username}',
user_type={$role},status={$status} WHERE id={$id}";

$result = mysqli_query($dbcon, $sql);


echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Password updated successfully!' : 'Something went wrong while updating password']);
exit;

mysqli_close($dbcon);
