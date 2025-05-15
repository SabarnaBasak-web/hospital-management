<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['APP_NAME', 'DB_HOST']); // Optional: validates that these exist

// Example usage
echo getenv('APP_NAME'); // Outputs: MyPHPApp
