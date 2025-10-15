<?php
// app/Controllers/WorkshopController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/includes/db_mysql.php';
require_once __DIR__ . '/../Models/Workshop.php';
require_once __DIR__ . '/../Models/BookingTransaction.php';

class WorkshopController
{
    private $databaseConnection;
    private $workshopModel;

    public function __construct()
    {
        $this->databaseConnection = require __DIR__ . '/../../config/includes/db_mysql.php';
        $this->workshopModel = new Workshop($this->databaseConnection);
    }

    // User: list workshops
    public function index()
    {
        $workshops = $this->workshopModel->all();
        require __DIR__ . '/../Views/workshops/index.php';
    }

    // User: show single workshop with booking form
    public function show($id)
    {
        $workshop = $this->workshopModel->find((int)$id);
        if (!$workshop) {
            http_response_code(404);
            echo "Workshop not found.";
            return;
        }
        require __DIR__ . '/../Views/workshops/show.php';
    }

    public function adminIndex()
    {
        $this->ensureAdmin();

        // ambil semua workshop untuk ditampilkan di halaman admin
        $workshops = $this->workshopModel->all();

        // load view admin (pastikan path view sesuai)
        require __DIR__ . '/../Views/admin/workshops/index.php';
    }

    // Admin: show create form
    public function adminCreate()
    {
        $this->ensureAdmin();
        require __DIR__ . '/../Views/admin/workshops/create.php';
    }

    // Admin: store new workshop
    public function adminStore()
    {
        $this->ensureAdmin();

        // ambil input, upload thumbnail jika ada
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $about = trim($_POST['about'] ?? '');
        $price = (int) ($_POST['price'] ?? 0);
        $startedAt = $_POST['started_at'] ?? null;
        $timeAt = $_POST['time_at'] ?? null;
        $address = $_POST['address'] ?? '';
        $isOpen = isset($_POST['is_open']) ? 1 : 0;
        $hasStarted = isset($_POST['has_started']) ? 1 : 0;

        // handle thumbnail upload
        $thumbnailPath = null;
        if (!empty($_FILES['thumbnail']['name'])) {
            $tmp = $_FILES['thumbnail']['tmp_name'];
            $orig = basename($_FILES['thumbnail']['name']);
            $ext = pathinfo($orig, PATHINFO_EXTENSION);
            $filename = uniqid('thumb_') . '.' . $ext;
            $dest = __DIR__ . '/../../public/uploads/' . $filename;
            if (move_uploaded_file($tmp, $dest)) {
                $thumbnailPath = '/uploads/' . $filename;
            }
        }

        $data = [
            'name' => $name,
            'slug' => $slug ?: strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name)),
            'thumbnail' => $thumbnailPath,
            'venue_thumbnail' => null,
            'about' => $about,
            'price' => $price,
            'started_at' => $startedAt,
            'time_at' => $timeAt,
            'address' => $address,
            'bg_map' => null,
            'is_open' => $isOpen,
            'has_started' => $hasStarted
        ];

        $inserted = $this->workshopModel->create($data);
        if ($inserted) {
            header('Location: /admin/workshops');
            exit;
        } else {
            echo "Gagal menyimpan workshop";
        }
    }

    // Admin: delete
    public function adminDelete($id)
    {
        $this->ensureAdmin();
        $this->workshopModel->delete((int)$id);
        header('Location: /admin/workshops');
        exit;
    }

    public function ensureAdmin()
    {
        if (empty($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            echo "Forbidden: admin only";
            exit;
        }
    }
}
