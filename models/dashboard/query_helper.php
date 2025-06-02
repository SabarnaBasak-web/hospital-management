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

    $sql = "SELECT bt.*, bd.name as department_name,bd.id as department_id FROM blood_tests bt JOIN blood_department bd on bd.id = bt.department_id";

    $result = mysqli_query($dbcon, $sql);
    $all_blood_tests = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_blood_tests;
}


function getAllPatientsEntries()
{
    global $dbcon;

    $sql = "SELECT pbt.*, bt.id AS blood_id, bt.test_name, bt.test_code,bt.code, bt.price_rate,bt.sale_rate, FROM patient_blood_test pbt INNER JOIN blood_tests bt on pbt.blood_test_id = bt.id";
    $result = mysqli_query($dbcon, $sql);
    $all_patient_entries = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_patient_entries;
}
