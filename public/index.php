<?php

// 1. Header CORS untuk mengizinkan Swagger UI mengakses API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// 2. Tangani Preflight Request (OPTIONS) dari browser
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 3. Jalankan Aplikasi
require __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->safeLoad();
App\Middleware\ErrorHandler::register();
$router = require __DIR__ . "/../routes/api.php";
$router->dispatch($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"]);