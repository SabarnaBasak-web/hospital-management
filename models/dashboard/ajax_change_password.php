<?php
session_start();
require_once __DIR__ . '/../connection_string.php';


$original_password = mysqli_real_escape_string($dbcon, $_POST['currentPassword']);
$new_password = mysqli_real_escape_string($dbcon, $_POST['newPassword']);
$confirm_password = mysqli_real_escape_string($dbcon, $_POST['renewPassword']);


if (empty($original_password) || empty($new_password) || empty($confirm_password)) {
    echo json_encode(['status' => 'error', 'message' => 'Fields cannot be empty']);
    exit;
}

if ($new_password != $confirm_password) {
    echo json_encode(['status' => "error", "message" => "Passwords don't match"]);
    exit;
}


$curr_user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM user u JOIN user_login u_login ON u_login.user_id = u.id WHERE u.id = '{$curr_user_id}'";
$result = mysqli_query($dbcon, $sql);
$num_rows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

// Verify Original Password
$is_match = password_verify($original_password, $row['password']);
if (!$is_match) {
    echo json_encode(['status' => 'error', 'message' => "Original password don't match"]);
    exit;
}

// Update the existing password
$hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
$sql = "UPDATE user_login SET password = '{$hashed_password}' WHERE user_id = '{$curr_user_id}'";

$result = mysqli_query($dbcon, $sql);
echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Password updated successfully!' : 'Something went wrong while updating password']);
exit;

mysqli_close($dbcon);
