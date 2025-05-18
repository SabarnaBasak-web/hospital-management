<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['name']) && !isset($_SESSION['role'])) {
    header('Location: ../../view/index.php');
} else {
    require_once __DIR__ . '/connection_string.php';
}
