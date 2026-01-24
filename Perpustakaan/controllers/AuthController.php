<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $koneksi = Database::connect();
        $this->user = new User($koneksi);
    }

    public function login() {
        include __DIR__ . '/../modules/auth/login.php';
    }

    public function loginProcess() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->user->login($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['role']    = $user['role'];

            header("Location: " . BASE_URL . "/dashboard");
        } else {
            $_SESSION['error'] = "Username atau password salah!";
            header("Location: " . BASE_URL . "/login");
        }
        exit;
    }

    public function register() {
        include __DIR__ . '/../modules/auth/register.php';
    }

    public function registerProcess() {
        $nama     = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($this->user->register($nama, $username, $password)) {
            $_SESSION['success'] = "Registrasi berhasil, silakan login!";
            header("Location: " . BASE_URL . "/login");
        } else {
            $_SESSION['error'] = "Username sudah digunakan!";
            header("Location: " . BASE_URL . "/register");
        }
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit;
    }
}
