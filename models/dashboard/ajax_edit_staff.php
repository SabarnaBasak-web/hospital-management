<?php
session_start();
require_once __DIR__ . '/../connection_string.php';


$fullname = mysqli_real_escape_string($dbcon, $_POST['full-name']);
$id = mysqli_real_escape_string($dbcon, $_POST['user-id']);
$username = mysqli_real_escape_string($dbcon, $_POST['edit-username']);
$phone = mysqli_real_escape_string($dbcon, $_POST['edit-staff-phone']);
$status = mysqli_real_escape_string($dbcon, $_POST['status']);
$role = mysqli_real_escape_string($dbcon, $_POST['edit-staff-role']);

$user_id = $_SESSION['user_id'];
$logged_in_user = $_SESSION['name'];

if (empty($fullname) || empty($id) || empty($phone) || empty($status) || empty($role)) {
    echo json_encode(['status' => 'error', 'message' => 'Fields cannot be empty']);
    exit;
}

$sql = "UPDATE user SET name='$fullname',username='$username',phone_number=$phone,user_type=$role,status=$status,
modified_by='$logged_in_user' WHERE id=$id";




$result = mysqli_query($dbcon, $sql);

if ($result) {
    $user_login_sql = "UPDATE user_login SET username='$username' WHERE user_id = $id";
    $update_result = mysqli_query($dbcon, $user_login_sql);

    if ($update_result) {
        echo json_encode(['status' => $update_result ? 'success' : 'error', 'message' => $update_result ? 'User details updated Successfully' : 'Something went wrong while updating user login details']);
        exit;
    }
}
echo json_encode(['status' => 'error', 'message' => 'Something went wrong while updating user details']);
exit;

mysqli_close($dbcon);
