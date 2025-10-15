<?php
// config/includes/config.php
if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'task_eventticket');
}
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}

// secret untuk registrasi admin
if (!defined('ADMIN_SECRET')) {
    define('ADMIN_SECRET', 'ADMIN2025');
}
