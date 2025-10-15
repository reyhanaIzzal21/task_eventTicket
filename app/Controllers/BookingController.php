<?php
// app/Controllers/BookingController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    /**
     * Menampilkan form booking berdasarkan slug
     */
    public function create(string $slug)
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Pastikan file model punya fungsi findBySlug()
        $workshop = $this->workshopModel->findBySlug($slug);

        if (!$workshop) {
            http_response_code(404);
            echo "Workshop tidak ditemukan.";
            return;
        }

        // Path view absolut dan aman
        $viewPath = __DIR__ . '/../Views/booking/booking_form.php';
        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo "File view tidak ditemukan: " . htmlspecialchars($viewPath);
            return;
        }

        // Pastikan variabel tersedia di view
        $data = [
            'workshop' => $workshop
        ];

        // Ekstrak data agar bisa dipakai di dalam view
        extract($data);

        require $viewPath;
    }


    /**
     * Menyimpan data booking ke database
     */
    public function store()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $workshopSlug = trim($_POST['workshop_slug'] ?? '');

        // pastikan workshop valid berdasarkan slug
        $workshop = $this->workshopModel->findBySlug($workshopSlug);
        if (!$workshop) {
            echo "Workshop tidak ditemukan.";
            return;
        }

        $workshopId = $workshop['id'];

        // Ambil data form
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $customerBankName = trim($_POST['customer_bank_name'] ?? '');
        $customerBankAccount = trim($_POST['customer_bank_account'] ?? '');
        $customerBankNumber = trim($_POST['customer_bank_number'] ?? '');
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));

        $totalAmount = $workshop['price'] * $quantity;

        // Upload proof (bukti transaksi)
        $proofPath = null;
        if (!empty($_FILES['proof']['name'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/proofs/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $orig = basename($_FILES['proof']['name']);
            $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png'];

            if (in_array($ext, $allowedExt)) {
                $filename = uniqid('proof_') . '.' . $ext;
                $dest = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['proof']['tmp_name'], $dest)) {
                    $proofPath = '/uploads/proofs/' . $filename;
                }
            }
        }

        // Generate kode transaksi unik
        $bookingTrxId = 'TRX-' . date('Ymd') . '-' . substr(uniqid(), -4);

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
            'is_paid' => 0, // default belum dibayar
            'quantity' => $quantity,
            'booking_trx_id' => $bookingTrxId
        ];

        // Simpan ke database via model
        $createdId = $this->bookingModel->create($data);

        if ($createdId) {
            header('Location: /booking/show/' . urlencode($bookingTrxId));
            exit;
        } else {
            echo "Gagal membuat booking. Coba lagi.";
        }
    }
    public function show(string $bookingTrxId)
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Cari data booking berdasarkan booking_trx_id
        $query = "SELECT bt.*, w.name AS workshop_name, w.slug AS workshop_slug, w.price AS workshop_price 
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

        $viewPath = __DIR__ . '/../Views/booking/booking_show.php';
        if (!file_exists($viewPath)) {
            echo "File view tidak ditemukan: " . htmlspecialchars($viewPath);
            return;
        }

        require $viewPath;
    }
}
