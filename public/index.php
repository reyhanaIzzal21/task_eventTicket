<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors','1');
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__)); // project root

// autoload sederhana
spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $appPath = BASE_PATH . '/app/' . $classPath;
    if (file_exists($appPath)) { require_once $appPath; return; }
    $possible = BASE_PATH . '/' . $classPath;
    if (file_exists($possible)) { require_once $possible; return; }
});

// load config
$configFile = BASE_PATH . '/config/includes/config.php';
if (!file_exists($configFile)) {
    http_response_code(500); echo "Config missing";
    exit;
}
require_once $configFile;

// load routes with normalized path
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])); // e.g. /myproject/public
if ($scriptName === '/' || $scriptName === '\\') {
    $scriptName = '';
}

// ambil path request dan hapus base scriptName
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = '/';
if ($scriptName !== '' && strpos($requestUri, $scriptName) === 0) {
    $path = substr($requestUri, strlen($scriptName));
}
if ($path === '') $path = '/';

// pastikan trailing slash konsisten
$path = rtrim($path, '/');
if ($path === '') $path = '/';

// buat variable global agar routes/web.php bisa pakai
$requestUri = $path;
$requestMethod = $_SERVER['REQUEST_METHOD'];

// debug optional: tulis ke file log untuk melihat path yang diterima
// file_put_contents(BASE_PATH . '/storage/request_log.txt', date('c') . " PATH: $path\n", FILE_APPEND);

require_once BASE_PATH . '../app/routes/web.php';
