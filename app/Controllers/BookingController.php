<?php
// app/Controllers/BookingController.php
session_start();
require_once __DIR__ . '/../../config/includes/db_mysql.php';
require_once __DIR__ . '/../Models/BookingTransaction.php';
require_once __DIR__ . '/../Models/Workshop.php';

class BookingController
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

    public function store()
    {
        // pastikan user login
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $customerBankName = trim($_POST['customer_bank_name'] ?? '');
        $customerBankAccount = trim($_POST['customer_bank_account'] ?? '');
        $customerBankNumber = trim($_POST['customer_bank_number'] ?? '');
        $workshopId = (int) ($_POST['workshop_id'] ?? 0);
        $quantity = max(1, (int) ($_POST['quantity'] ?? 1));

        $workshop = $this->workshopModel->find($workshopId);
        if (!$workshop) {
            echo "Workshop tidak ditemukan";
            return;
        }

        $totalAmount = $workshop['price'] * $quantity;

        // handle proof upload (optional)
        $proofPath = null;
        if (!empty($_FILES['proof']['name'])) {
            $tmp = $_FILES['proof']['tmp_name'];
            $orig = basename($_FILES['proof']['name']);
            $ext = pathinfo($orig, PATHINFO_EXTENSION);
            $filename = uniqid('proof_') . '.' . $ext;
            $dest = __DIR__ . '/../../public/uploads/proofs/' . $filename;
            if (move_uploaded_file($tmp, $dest)) {
                $proofPath = '/uploads/proofs/' . $filename;
            }
        }

        // generate booking_trx_id: TRX-YYYYMMDD-XXXX
        $datePrefix = date('Ymd');
        $randomSuffix = substr(uniqid(), -4);
        $bookingTrxId = "TRX-{$datePrefix}-{$randomSuffix}";

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'customer_bank_name' => $customerBankName,
            'customer_bank_account' => $customerBankAccount,
            'customer_bank_number' => $customerBankNumber,
            'proof' => $proofPath,
            'total_amount' => $totalAmount,
            'workshop_id' => $workshopId,
            'is_paid' => 0, // menunggu approve
            'quantity' => $quantity,
            'booking_trx_id' => $bookingTrxId
        ];

        $createdId = $this->bookingModel->create($data);
        if ($createdId) {
            // optional: simpan booking_transaction_id ke user (jika perlu)
            // redirect to user dashboard with success
            header('Location: /user/dashboard?message=booking_success&trx=' . urlencode($bookingTrxId));
            exit;
        } else {
            echo "Gagal membuat booking, coba lagi.";
        }
    }
}
