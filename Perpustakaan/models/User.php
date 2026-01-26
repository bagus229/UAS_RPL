<?php
class User {
    private $db;

    public function __construct($koneksi) {
        if (!$koneksi) {
            die("Koneksi database tidak tersedia di User model");
        }
        $this->db = $koneksi;
    }

    public function login($username) {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function register($nama, $username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (nama, username, password, role)
             VALUES (?, ?, ?, 'user')"
        );
        $stmt->bind_param("sss", $nama, $username, $hash);
        return $stmt->execute();
    }
}
