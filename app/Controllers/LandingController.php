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
        $workshops = $this->workshopModel->getAllOpenWorkshops();
        require __DIR__ . '/../Views/landing-page/index.php';
    }
}
