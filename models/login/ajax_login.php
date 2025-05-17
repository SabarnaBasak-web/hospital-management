<?php
session_start();


require_once __DIR__ . '/../connection_string.php';

$username = mysqli_real_escape_string($dbcon, $_POST['username']);
$password = mysqli_real_escape_string($dbcon, $_POST['password']);


$sql = "SELECT * FROM user_login ulogin JOIN user usr JOIN user_role urole ON ulogin.user_id = usr.id AND usr.user_type = urole.id WHERE ulogin.username='{$username}' AND ulogin.password = '{$password}'";


$result = mysqli_query($dbcon, $sql);
$num_rows = mysqli_num_rows($result);


if ($num_rows == 0) {
    echo json_encode(['status' => 'error', 'message' => "Invalid username or password", "rows" => $num_rows]);
    exit;
}


$row = mysqli_fetch_assoc($result);

if ($row['status'] == 0) {
    echo json_encode(['status' => "error", 'message' => "User is inactive !"]);
    exit;
}
$user_id = $row['user_id'];
$name = $row['name'];
$role = $row['role_name'];



$_SESSION['user_id'] = $user_id;
$_SESSION['name'] = $name;
$_SESSION['role'] = $role;

echo json_encode(['status' => "success", "message" => "Success!"]);



mysqli_close($dbcon);
