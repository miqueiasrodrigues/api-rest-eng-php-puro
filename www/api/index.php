<?php
require_once __DIR__ . '/src/Config/config.php';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Sao_Paulo');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: " . implode(',', ALLOWED_METHODS));

header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");


require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/src/Routes/index.php';
