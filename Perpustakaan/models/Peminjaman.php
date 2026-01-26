<?php

class Peminjaman {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "perpustakaan");
    }

    public function all() {
        $sql = "
            SELECT 
                p.id_peminjaman,
                a.nama AS nama_anggota,
                b.judul,
                p.tgl_pinjam,
                p.tgl_kembali,
                p.status,
                p.denda
            FROM peminjaman p
            JOIN anggota a ON p.id_anggota = a.id_anggota
            JOIN buku b ON p.id_buku = b.id_buku
            ORDER BY p.id_peminjaman DESC
        ";

        return $this->db->query($sql);
    }

    public function create($id_anggota, $id_buku, $tgl_pinjam) {
        $sql = "INSERT INTO peminjaman 
                (id_anggota, id_buku, tgl_pinjam, status)
                VALUES (?, ?, ?, 'menunggu')";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis", $id_anggota, $id_buku, $tgl_pinjam);

        if ($stmt->execute()) {
            return ['status' => true, 'message' => 'Peminjaman disimpan'];
        }

        return ['status' => false, 'message' => 'Gagal menyimpan'];
    }

    public function setujui($id_peminjaman) {
        $data = $this->db->query("
            SELECT id_buku 
            FROM peminjaman 
            WHERE id_peminjaman = '$id_peminjaman'
        ")->fetch_assoc();

        $this->db->query("
            UPDATE buku 
            SET stok = stok - 1 
            WHERE id_buku = '{$data['id_buku']}'
        ");

        $this->db->query("
            UPDATE peminjaman 
            SET status = 'dipinjam'
            WHERE id_peminjaman = '$id_peminjaman'
        ");
    }

    public function kembali($id_peminjaman, $tgl_kembali) {

        $data = $this->db->query("
            SELECT id_buku, tgl_pinjam 
            FROM peminjaman 
            WHERE id_peminjaman = '$id_peminjaman'
        ")->fetch_assoc();

        $hari = (strtotime($tgl_kembali) - strtotime($data['tgl_pinjam'])) / 86400;
        $denda = ($hari > 7) ? ($hari - 7) * 2000 : 0;

        $this->db->query("
            UPDATE peminjaman 
            SET 
                tgl_kembali = '$tgl_kembali',
                status = 'dikembalikan',
                denda = '$denda'
            WHERE id_peminjaman = '$id_peminjaman'
        ");

        $this->db->query("
            UPDATE buku 
            SET stok = stok + 1 
            WHERE id_buku = '{$data['id_buku']}'
        ");
    }

    public function hapus($id) {
        $this->db->query("DELETE FROM peminjaman WHERE id_peminjaman = '$id'");
    }

    public function getBuku() {
        return $this->db->query("SELECT * FROM buku WHERE stok > 0");
    }

    public function getAnggota() {
        return $this->db->query("SELECT * FROM anggota");
    }

    public function tolak($id_peminjaman) {
        $sql = "
            UPDATE peminjaman 
            SET status = 'ditolak'
            WHERE id_peminjaman = '$id_peminjaman'
        ";

        return $this->db->query($sql);
    }
}
