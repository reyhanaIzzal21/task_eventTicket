<?php
// app/Controllers/AdminController.php
session_start();
require_once __DIR__ . '/../../config/includes/db_mysql.php';
require_once __DIR__ . '/../Models/BookingTransaction.php';

class AdminController
{
    private $databaseConnection;
    private $bookingModel;

    public function __construct()
    {
        $this->databaseConnection = require __DIR__ . '/../../config/includes/db_mysql.php';
        $this->bookingModel = new BookingTransaction($this->databaseConnection);
        $this->ensureAdmin();
    }

    public function bookings()
    {
        $bookings = $this->bookingModel->all();
        require __DIR__ . '/../Views/admin/bookings.php';
    }

    public function approveBooking($id)
    {
        $this->bookingModel->updateIsPaid((int)$id, 1);
        header('Location: /admin/bookings');
        exit;
    }

    private function ensureAdmin()
    {
        if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            echo "Forbidden: admin only";
            exit;
        }
    }
}
