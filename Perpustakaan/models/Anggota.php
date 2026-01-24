<?php
require_once __DIR__ . '/../config/database.php';

class Anggota {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        return $this->db->query("SELECT * FROM anggota");
    }

    public function find($id) {
        $stmt = $this->db->prepare(
            "SELECT * FROM anggota WHERE id_anggota = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nama, $alamat, $telepon) {
        $stmt = $this->db->prepare(
            "INSERT INTO anggota (nama, alamat, telepon)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $nama, $alamat, $telepon);
        return $stmt->execute();
    }

    public function update($id, $nama, $alamat, $telepon) {
        $stmt = $this->db->prepare(
            "UPDATE anggota
             SET nama = ?, alamat = ?, telepon = ?
             WHERE id_anggota = ?"
        );
        $stmt->bind_param("sssi", $nama, $alamat, $telepon, $id);
        return $stmt->execute();
    }

    /* ===== DELETE (INI YANG TADI HILANG) ===== */
    public function delete($id) {
        $stmt = $this->db->prepare(
            "DELETE FROM anggota WHERE id_anggota = ?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
