<?php
// routes/web.php

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Ping test
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

// WORKSHOPS (user)
if ($requestUri === '/' && $requestMethod === 'GET') {
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

// BOOKING STORE
if ($requestUri === '/booking/store' && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/BookingController.php';
    $controller = new BookingController();
    $controller->store();
    exit;
}

// Booking cerate
if ($requestUri === '/booking/create' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/BookingController.php';
    $controller = new BookingController();
    $controller->store();
    exit;
}

// Booking show (by booking_trx_id)
if (preg_match('#^/booking/show/([A-Za-z0-9\-_]+)$#', $requestUri, $matches) && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/BookingController.php';
    $controller = new BookingController();
    $controller->show($matches[1]);
    exit;
}


// Booking create by workshop slug
if (preg_match('#^/booking/create/([^/]+)$#', $requestUri, $matches) && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/BookingController.php';
    $controller = new BookingController();
    $controller->create($matches[1]);
    exit;
}



// Admin: workshops (list)
if ($requestUri === '/admin/workshops' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminIndex();
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

// ✅ Admin: edit workshop form
if (preg_match('#^/admin/workshops/edit/(\d+)$#', $requestUri, $matches) && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminEdit($matches[1]);
    exit;
}

// ✅ Admin: update existing workshop
if (preg_match('#^/admin/workshops/update/(\d+)$#', $requestUri, $matches) && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminUpdate($matches[1]);
    exit;
}

// Admin: delete workshop
if (preg_match('#^/admin/workshops/delete/(\d+)$#', $requestUri, $matches) && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->adminDelete($matches[1]);
    exit;
}

// ADMIN BOOKINGS
if ($requestUri === '/admin/bookings' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->bookings();
    exit;
}

// Admin approve booking
if (preg_match('#^/admin/bookings/approve/(\d+)$#', $requestUri, $matches) && $requestMethod === 'POST') {
    require_once __DIR__ . '/../../app/Controllers/AdminController.php';
    $controller = new AdminController();
    $controller->approveBooking($matches[1]);
    exit;
}

// Tampilkan semua workshop (list)
if ($requestUri === '/workshops' && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->index();
    exit;
}

// Tampilkan detail workshop berdasarkan ID
if (preg_match('#^/workshops/([a-zA-Z0-9\-]+)$#', $requestUri, $matches) && $requestMethod === 'GET') {
    require_once __DIR__ . '/../../app/Controllers/WorkshopController.php';
    $controller = new WorkshopController();
    $controller->show($matches[1]);
    exit;
}
