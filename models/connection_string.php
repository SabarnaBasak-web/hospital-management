<?php

require __DIR__ . '/../PHPDotEnv/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..', '.env');
$dotenv->load();
$dbhost = $_ENV['DB_HOST'];
$dbusername = $_ENV['DB_USERNAME'];
$dbpassword = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];


echo  $dbhost . " " . $dbusername . " " . $dbpassword . " " . $dbname;
$dbcon = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname) or die("Could not connect to server");
