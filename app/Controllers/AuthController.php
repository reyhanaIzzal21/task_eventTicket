<?php
// app/Controllers/AuthController.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/includes/db_mysql.php'; // returns mysqli connection
require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    private $databaseConnection;
    private $userModel;

    public function __construct()
    {
        // ambil koneksi (db_mysql.php akan return mysqli)
        $this->databaseConnection = require __DIR__ . '/../../config/includes/db_mysql.php';
        $this->userModel = new User($this->databaseConnection);
    }

    // show register form
    public function showRegister()
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    // get all user
    public function getAllUser()
    {
        $userRecords = $this->userModel->getAllUser();
        require __DIR__ . '/../Views/admin/users/index.php';
    }

    // handle register post
    public function register()
    {
        $name = trim($_POST['name'] ?? '');
        $occupation = trim($_POST['occupation'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        $errors = [];

        if ($name === '') {
            $errors[] = "Name is required.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is not valid.";
        }
        if (strlen($password) < 6) {
            $errors[] = "Password minimal 6 karakter.";
        }
        if ($password !== $passwordConfirm) {
            $errors[] = "Password confirmation does not match.";
        }

        // stop if errors
        if (!empty($errors)) {
            // buat variable $registerErrors dipakai di view
            $registerErrors = $errors;
            $old = ['name' => $name, 'occupation' => $occupation, 'email' => $email];
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        // cek duplicate email
        $existingUser = $this->userModel->findByEmail($email);
        if ($existingUser) {
            $registerErrors = ["Email sudah digunakan."];
            $old = ['name' => $name, 'occupation' => $occupation, 'email' => $email];
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'name' => $name,
            'occupation' => $occupation,
            'email' => $email,
            'password' => $hashedPassword
        ];

        $createdId = $this->userModel->create($userData);
        if ($createdId) {
            // sukses -> redirect to login
            header('Location: /login');
            exit;
        } else {
            $registerErrors = ["Gagal menyimpan data. Coba lagi."];
            $old = ['name' => $name, 'occupation' => $occupation, 'email' => $email];
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }
    }

    // show login form
    public function showLogin()
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    // handle login post
    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $loginErrors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loginErrors[] = "Email tidak valid.";
        }
        if ($password === '') {
            $loginErrors[] = "Password diperlukan.";
        }

        if (!empty($loginErrors)) {
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        $userRecord = $this->userModel->findByEmail($email);
        if (!$userRecord) {
            $loginErrors[] = "Email atau password salah.";
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        if (!password_verify($password, $userRecord['password'])) {
            $loginErrors[] = "Email atau password salah.";
            require __DIR__ . '/../Views/auth/login.php';
            return;
        }

        // sukses login -> set session
        $_SESSION['user_id'] = $userRecord['id'];
        $_SESSION['user_name'] = $userRecord['name'];
        $_SESSION['user_email'] = $userRecord['email'];
        $_SESSION['user_role'] = $userRecord['role'];

        // redirect sesuai role (example)
        if ($userRecord['role'] === 'admin') {
            header('Location: /admin/workshops');
            exit;
        } else {
            header('Location: /workshops');
            exit;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
}