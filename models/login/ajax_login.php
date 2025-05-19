<?php
session_start();
require_once __DIR__ . '/../connection_string.php';

$username = mysqli_real_escape_string($dbcon, $_POST['username']);
$password = mysqli_real_escape_string($dbcon, $_POST['password']);


if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => "Username or password cannot be empty"]);
    exit;
}

$sql = "SELECT * FROM user_login ulogin JOIN user usr JOIN user_role urole ON ulogin.user_id = usr.id AND usr.user_type = urole.id WHERE ulogin.username='{$username}'";


$result = mysqli_query($dbcon, $sql);
$num_rows = mysqli_num_rows($result);


if ($num_rows == 0) {
    echo json_encode(['status' => 'error', 'message' => "Username doesn't exists"]);
    exit;
}
$row = mysqli_fetch_assoc($result);


$is_match = password_verify($password, $row['password']);

if (!$is_match) {
    echo json_encode(['status' => 'error', 'message' => "Incorrect username or password"]);
    exit;
}

if ($row['status'] == 0) {
    echo json_encode(['status' => "error", 'message' => "User is inactive !"]);
    exit;
}
$user_id = $row['user_id'];
$name = $row['name'];
$role = $row['role_name'];
$user_name = $row['username'];



$_SESSION['user_id'] = $user_id;
$_SESSION['name'] = $name;
$_SESSION['role'] = $role;
$_SESSION['username'] = $user_name;

echo json_encode(['status' => "success", "message" => "Success!"]);


mysqli_close($dbcon);
