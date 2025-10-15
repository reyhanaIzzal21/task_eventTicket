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
    public function show(string $slug)
    {
        $workshop = $this->workshopModel->findBySlug($slug);
        if (!$workshop) {
            echo "Workshop tidak ditemukan.";
            return;
        }

        require __DIR__ . '/../Views/workshops/show.php';
    }

    public function adminIndex()
    {
        $this->ensureAdmin();
        $workshops = $this->workshopModel->all();
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

        $name = trim($_POST['name'] ?? '');
        $about = trim($_POST['about'] ?? '');
        $price = (int) ($_POST['price'] ?? 0);
        $startedAt = $_POST['started_at'] ?? null;
        $timeAt = $_POST['time_at'] ?? null;
        $address = $_POST['address'] ?? '';
        $bgMap = trim($_POST['bg_map'] ?? null);
        $isOpen = isset($_POST['is_open']) ? 1 : 0;
        $hasStarted = isset($_POST['has_started']) ? 1 : 0;

        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Upload thumbnail utama
        $thumbnailPath = null;
        if (!empty($_FILES['thumbnail']['name'])) {
            $tmp = $_FILES['thumbnail']['tmp_name'];
            $orig = basename($_FILES['thumbnail']['name']);
            $ext = pathinfo($orig, PATHINFO_EXTENSION);
            $filename = uniqid('thumb_') . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($tmp, $dest)) {
                $thumbnailPath = '/uploads/' . $filename;
            }
        }

        // Upload venue thumbnail (🔹 tambahan baru)
        $venueThumbnailPath = null;
        if (!empty($_FILES['venue_thumbnail']['name'])) {
            $tmpVenue = $_FILES['venue_thumbnail']['tmp_name'];
            $origVenue = basename($_FILES['venue_thumbnail']['name']);
            $extVenue = pathinfo($origVenue, PATHINFO_EXTENSION);
            $venueName = uniqid('venue_') . '.' . $extVenue;
            $venueDest = $uploadDir . $venueName;
            if (move_uploaded_file($tmpVenue, $venueDest)) {
                $venueThumbnailPath = '/uploads/' . $venueName;
            }
        }

        // Data workshop
        $data = [
            'name' => $name,
            'thumbnail' => $thumbnailPath,
            'venue_thumbnail' => $venueThumbnailPath,
            'about' => $about,
            'price' => $price,
            'started_at' => $startedAt,
            'time_at' => $timeAt,
            'address' => $address,
            'bg_map' => $bgMap,
            'is_open' => $isOpen,
            'has_started' => $hasStarted
        ];

        $inserted = $this->workshopModel->create($data);

        if ($inserted) {
            header('Location: /admin/workshops');
            exit;
        } else {
            echo "Gagal menyimpan workshop.";
        }
    }

    // Admin: show edit form
    public function adminEdit($id)
    {
        $this->ensureAdmin();

        $workshop = $this->workshopModel->find((int) $id);
        if (!$workshop) {
            http_response_code(404);
            echo "Workshop not found.";
            return;
        }

        require __DIR__ . '/../Views/admin/workshops/edit.php';
    }

    // Admin: update existing workshop
    public function adminUpdate($id)
    {
        $this->ensureAdmin();

        $workshop = $this->workshopModel->find((int) $id);
        if (!$workshop) {
            echo "Workshop not found.";
            return;
        }

        $name = trim($_POST['name'] ?? '');
        $about = trim($_POST['about'] ?? '');
        $price = (int) ($_POST['price'] ?? 0);
        $startedAt = $_POST['started_at'] ?? null;
        $timeAt = $_POST['time_at'] ?? null;
        $address = $_POST['address'] ?? '';
        $bgMap = trim($_POST['bg_map'] ?? null);
        $isOpen = isset($_POST['is_open']) ? 1 : 0;
        $hasStarted = isset($_POST['has_started']) ? 1 : 0;

        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Thumbnail utama
        $thumbnailPath = $workshop['thumbnail'];
        if (!empty($_FILES['thumbnail']['name'])) {
            $tmp = $_FILES['thumbnail']['tmp_name'];
            $orig = basename($_FILES['thumbnail']['name']);
            $ext = pathinfo($orig, PATHINFO_EXTENSION);
            $filename = uniqid('thumb_') . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($tmp, $dest)) {
                $thumbnailPath = '/uploads/' . $filename;
            }
        }

        // Venue thumbnail (🔹 baru)
        $venueThumbnailPath = $workshop['venue_thumbnail'];
        if (!empty($_FILES['venue_thumbnail']['name'])) {
            $tmpVenue = $_FILES['venue_thumbnail']['tmp_name'];
            $origVenue = basename($_FILES['venue_thumbnail']['name']);
            $extVenue = pathinfo($origVenue, PATHINFO_EXTENSION);
            $venueName = uniqid('venue_') . '.' . $extVenue;
            $venueDest = $uploadDir . $venueName;
            if (move_uploaded_file($tmpVenue, $venueDest)) {
                $venueThumbnailPath = '/uploads/' . $venueName;
            }
        }

        $data = [
            'name' => $name,
            'thumbnail' => $thumbnailPath,
            'venue_thumbnail' => $venueThumbnailPath,
            'about' => $about,
            'price' => $price,
            'started_at' => $startedAt,
            'time_at' => $timeAt,
            'address' => $address,
            'bg_map' => $bgMap,
            'is_open' => $isOpen,
            'has_started' => $hasStarted
        ];

        $updated = $this->workshopModel->update((int) $id, $data);

        if ($updated) {
            header('Location: /admin/workshops');
            exit;
        } else {
            echo "Gagal mengupdate workshop.";
        }
    }

    // Admin: delete
    public function adminDelete($id)
    {
        $this->ensureAdmin();
        $this->workshopModel->delete((int) $id);
        header('Location: /admin/workshops');
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
