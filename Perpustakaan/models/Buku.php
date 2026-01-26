<?php
require_once __DIR__ . '/../config/Database.php';

class Buku {
    private $db;
    public function __construct() {
        $this->db = Database::connect();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM buku WHERE id_buku=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($judul, $pengarang, $penerbit, $tahun, $stok, $gambar) {
        $stmt = $this->db->prepare(
            "INSERT INTO buku (judul,pengarang,penerbit,tahun,stok,gambar)
             VALUES (?,?,?,?,?,?)"
        );
        $stmt->bind_param("sssiss", $judul, $pengarang, $penerbit, $tahun, $stok, $gambar);
        return $stmt->execute();
    }

    public function update($id, $judul, $pengarang, $penerbit, $tahun, $stok, $gambar) {
        $stmt = $this->db->prepare(
            "UPDATE buku SET judul=?, pengarang=?, penerbit=?, tahun=?, stok=?, gambar=?
             WHERE id_buku=?"
        );
        $stmt->bind_param("sssissi", $judul, $pengarang, $penerbit, $tahun, $stok, $gambar, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM buku WHERE id_buku=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function paginate($limit, $offset) {
        $stmt = $this->db->prepare("SELECT * FROM buku LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function countData() {
        return $this->db->query("SELECT COUNT(*) total FROM buku")
                        ->fetch_assoc()['total'];
    }

    public function searchPaginate($key, $limit, $offset) {
        $key = "%$key%";
        $stmt = $this->db->prepare(
            "SELECT * FROM buku WHERE judul LIKE ? OR pengarang LIKE ? LIMIT ? OFFSET ?"
        );
        $stmt->bind_param("ssii", $key, $key, $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function countSearch($key) {
        $key = "%$key%";
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) total FROM buku WHERE judul LIKE ? OR pengarang LIKE ?"
        );
        $stmt->bind_param("ss", $key, $key);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function kurangiStok($id_buku, $jumlah = 1) {
        $stmt = $this->db->prepare(
            "UPDATE buku 
             SET stok = stok - ? 
             WHERE id_buku = ? AND stok >= ?"
        );
        $stmt->bind_param("iii", $jumlah, $id_buku, $jumlah);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function tambahStok($id_buku, $jumlah = 1) {
        $stmt = $this->db->prepare(
            "UPDATE buku SET stok = stok + ? WHERE id_buku = ?"
        );
        $stmt->bind_param("ii", $jumlah, $id_buku);
        return $stmt->execute();
    }
}
