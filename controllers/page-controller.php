<?php

require_once __DIR__ . '/../helpers/function.php';

$request_uri = $_SERVER['REQUEST_URI'];
$server_name = $_SERVER['SERVER_NAME']; // localhost

$base_url = base_url();
$base_url_length = strlen($base_url);

$url = substr($request_uri, $base_url_length);
$page_name = explode('/', $url)[0]; // index.php | dashboard.php


if ($_SERVER['REQUEST_URI'] == base_url()) {
    $page_name = 'index';
}

$page_title = [
    'login' => 'Login Admin | ' . project_name(),
    'dashboard' => 'Dashboard | ' . project_name(),
    'manage-profile' => 'Manage Profile | ' . project_name(),
    'add-blood-tests' => 'Add Blood Test |' . project_name(),
];



if (!array_key_exists($page_name, $page_title)) {
    $page_name = '404';
}
