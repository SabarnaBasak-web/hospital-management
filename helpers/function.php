<?php
require __DIR__ . '/../PHPDotEnv/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..', '.env');
$dotenv->load();

$app_name = $_ENV['APP_NAME'];
$GLOBALS['project_name'] = $app_name;

date_default_timezone_set($_ENV['TIME_ZONE']);

function project_name()
{
    return $GLOBALS['project_name'];
}

function base_url()
{
    $server_name = $_SERVER['SERVER_NAME'];

    if ($server_name === 'localhost') {
        $base_url = $_ENV['BASE_URL']; // folder name
    } else {
        $base_url = $_ENV['BASE_URL'];
    }



    return $base_url;
}
