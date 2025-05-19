<?php
require_once __DIR__ . '/../connection_string.php';

function getCurrentUserDetails()
{
    global $dbcon;

    $curr_user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user u JOIN user_role u_role ON u.user_type = u_role.id WHERE u.id= {$curr_user_id}";

    $result = mysqli_query($dbcon, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 0) return [];
    $row = mysqli_fetch_assoc($result);

    return $row;
}


function getUserRoles()
{
    global $dbcon;

    $sql = "SELECT * FROM user_role";

    $result = mysqli_query($dbcon, $sql);
    $all_roles = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_roles;
}
