<?php
include_once __DIR__ . '/../models/session_check.php';

$PASSWORD_LENGTH = 6;

function isSuperAdmin()
{
    $curr_user_role =  $_SESSION['role'];
    return $curr_user_role == 'Super Admin';
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
