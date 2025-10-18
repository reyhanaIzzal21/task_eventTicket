<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/includes/db_mysql.php';
require_once __DIR__ . '/../Models/BookingTransaction.php';
require_once __DIR__ . '/../Models/Workshop.php';


class LandingController
{
    private $databaseConnection;
    private $bookingModel;
    private $workshopModel;

    public function __construct()
    {
        $this->databaseConnection = require __DIR__ . '/../../config/includes/db_mysql.php';
        $this->bookingModel = new BookingTransaction($this->databaseConnection);
        $this->workshopModel = new Workshop($this->databaseConnection);
    }

    public function index()
    {
        $workshops = $this->workshopModel->all();
        $workshops = array_slice($workshops, 0, 3); 
        require __DIR__ . '/../Views/landing-page/index.php';
    }

    public function getWorkshops()
    {
        // dapatkan query string dari URL
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
        // optional: limit bisa dikirim via ?limit=3, kalau tidak dikirim maka null (ambil semua)
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : null;

        $workshops = $this->workshopModel->search($q, $filter, $limit);
        require __DIR__ . '/../Views/workshops/index.php';
    }
}
