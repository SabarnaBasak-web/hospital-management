<?php
include_once __DIR__ . '/../models/session_check.php';
include_once __DIR__ . '/../constants/constants.php';

$PASSWORD_LENGTH = 6;

function isSuperAdmin()
{
    $curr_user_role =  $_SESSION['role'];
    return $curr_user_role == UserRole::SUPERADMIN;
}

function generatePassword()
{
    global $PASSWORD_LENGTH;

    $characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $password = "";
    for ($i = 0; $i < $PASSWORD_LENGTH; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    str_shuffle($password);

    return $password;
}


function getStaffDetailsByStaffId($all_staffs, $staff_id)
{

    $staff_details = null;
    foreach ($all_staffs as $staff) {
        if ($staff['id'] == $staff_id) {
            $staff_details = $staff;
            break;
        }
    }
    return $staff_details;
}
