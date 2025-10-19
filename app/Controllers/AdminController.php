<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    public function index()
    {
        $this->ensureAdmin();
        $bookings = $this->bookingModel->all();
        require __DIR__ . '/../Views/admin/bookings/index.php';
    }

    public function show(string $bookingTrxId)
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Cari data booking berdasarkan booking_trx_id
        $query = "SELECT bt.*, w.name AS workshop_name, w.started_at AS workshop_started_at, w.price AS workshop_price, w.thumbnail AS workshop_thumbnail, w.address AS workshop_address
              FROM booking_transaction bt
              JOIN workshop w ON bt.workshop_id = w.id
              WHERE bt.booking_trx_id = ? LIMIT 1";

        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('s', $bookingTrxId);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();
        $stmt->close();

        if (!$booking) {
            http_response_code(404);
            echo "Transaksi booking tidak ditemukan.";
            return;
        }

        $viewPath = __DIR__ . '/../Views/admin/bookings/show.php';
        if (!file_exists($viewPath)) {
            echo "File view tidak ditemukan: " . htmlspecialchars($viewPath);
            return;
        }

        require $viewPath;
    }

    public function approveBooking($id)
    {
        $this->ensureAdmin();
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
