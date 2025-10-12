<?php

require __DIR__ . '/config.php';

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysql->connect_errno) {
    die("Gagal terhubung ke database " . DB_NAME . ": " . $mysql->connect_error);
}

return $mysql;