<?php
session_start();
require_once __DIR__ . '/../connection_string.php';


$fullname = mysqli_real_escape_string($dbcon, $_POST['full-name']);
$id = mysqli_real_escape_string($dbcon, $_POST['id']);
$phone = mysqli_real_escape_string($dbcon, $_POST['phone']);
$status = mysqli_real_escape_string($dbcon, $_POST['status']);
$role = mysqli_real_escape_string($dbcon, $_POST['role']);

$user_id = $_SESSION['user_id'];
$logged_in_user = $_SESSION['name'];

if (empty($fullname) || empty($id) || empty($phone) || empty($status) || empty($role)) {
    echo json_encode(['status' => 'error', 'message' => 'Fields cannot be empty']);
    exit;
}
echo "UPDATE `user` SET `name`='$fullname',`phone_number`='$phone',`user_type`='$role',`status`='$status',
`modified_date`='$logged_in_user' WHERE `id`='$id'";
die;

$sql = "UPDATE `user` SET `name`='$fullname',`phone_number`='$phone',`user_type`='$role',`status`='$status',
`modified_date`='$logged_in_user' WHERE `id`='$id'";




$result = mysqli_query($dbcon, $sql);
echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Password updated successfully!' : 'Something went wrong while updating password']);
exit;

mysqli_close($dbcon);
