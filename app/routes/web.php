<?php
// routes/web.php

// pastikan base includes dan autoload sudah diatur di index.php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/ping' && $requestMethod === 'GET') {
    echo "pong";
    exit;
}

// REGISTER
if ($requestUri === '/register' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->showRegister();
    exit;
}

if ($requestUri === '/register' && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->register();
    exit;
}

// LOGIN
if ($requestUri === '/login' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->showLogin();
    exit;
}

if ($requestUri === '/login' && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->login();
    exit;
}

// LOGOUT
if ($requestUri === '/logout') {
    require_once __DIR__ . '/../../app/Controllers/AuthController.php';
    $controller = new AuthController();
    $controller->logout();
    exit;
}

// Workshop user
if (preg_match('#^/ $#', $requestUri) && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->index();
    exit;
}

if (preg_match('#^/workshops/show/(\d+)$#', $requestUri, $matches) && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->show($matches[1]);
    exit;
}

// Booking store
if ($requestUri === '/booking/store' && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/BookingController.php';
    $controller = new BookingController();
    $controller->store();
    exit;
}

// Admin: workshops (list)
if ($requestUri === '/admin/workshops' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminIndex(); // method publik yang aman
    exit;
}
// Admin: create workshop form
if ($requestUri === '/admin/workshops/create' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminCreate();
    exit;
}
// Admin: store new workshop
if ($requestUri === '/admin/workshops/store' && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminStore();
    exit;
}
// // Admin: edit workshop form
// if ($requestUri === '/admin/workshops/edit/(\d+)' && $requestMethod === 'GET') {
//     require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
//     $controller = new WorkshopController();
//     $controller->adminEdit($matches[1]);
//     exit;
// }
// // Admin: update workshop
// if ($requestUri === '/admin/workshops/update/(\d+)' && $requestMethod === 'POST') {
//     require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
//     $controller = new WorkshopController();
//     $controller->adminUpdate($matches[1]);
//     exit;
// }
// Admin: delete workshop
if ($requestUri === '/admin/workshops/delete/(\d+)' && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminDelete($matches[1]);
    exit;
}
// Admin: show workshop
// if ($requestUri === '/admin/workshops/show/(\d+)' && $requestMethod === 'GET') {
//     require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
//     $controller = new WorkshopController();
//     $controller->adminShow($matches[1]);
//     exit;
// }



// Admin bookings
if ($requestUri === '/admin/bookings' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->bookings();
    exit;
}

// Admin approve booking (POST)
if (preg_match('#^/admin/bookings/approve/(\d+)$#', $requestUri, $matches) && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->approveBooking($matches[1]);
    exit;
}

