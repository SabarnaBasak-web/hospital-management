<?php
include_once __DIR__ . '/../models/session_check.php';

function isSuperAdmin()
{
    $curr_user_role =  $_SESSION['role'];
    return $curr_user_role == 'Super Admin';
}
