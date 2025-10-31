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
    define('ADMIN_SECRET', 'ADMINITUGAJAH2025');
}

// secret khusus untuk QR/token (lebih baik pisah dari ADMIN_SECRET)
if (!defined('QR_SECRET')) {
    define('QR_SECRET', 'please_change_this_to_a_long_random_string');
}