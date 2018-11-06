<?php

session_start();

if (isset($_SERVER) && isset($_SERVER['REMOTE_ADDR']))
{
    $configPHP   = '../config/local.php';
    $localConfig = file_exists($configPHP) ? require_once($configPHP) : [];
}

require_once '../vendor/autoload.php';

// start the application
$app = new Core\Application($localConfig);