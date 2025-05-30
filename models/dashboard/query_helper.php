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


function getBloodDepartments()
{
    global $dbcon;

    $sql = "SELECT * FROM blood_department";

    $result = mysqli_query($dbcon, $sql);
    $all_blood_departments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_blood_departments;
}


function getAllBloodTests()
{
    global $dbcon;

    $sql = "SELECT bd.name as department_name,bt.* FROM blood_tests bt JOIN blood_department bd on bd.id = bt.department_id";

    $result = mysqli_query($dbcon, $sql);
    $all_blood_tests = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_blood_tests;
}
function getAllStaff()
{
    global $dbcon;


    $sql = "SELECT * FROM user 
    INNER JOIN user_login ON user.id = user_login.user_id 
    INNER JOIN user_role ON user.user_type = user_role.id ORDER BY user_id DESC;";

    $result = mysqli_query($dbcon, $sql);
    $all_staff = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_staff;
}
