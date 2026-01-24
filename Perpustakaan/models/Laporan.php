<?php
require_once __DIR__ . '/Peminjaman.php';

class Laporan {
    private $peminjaman;

    public function __construct() {
        $this->peminjaman = new Peminjaman();
    }

    public function getAll() {
        return $this->peminjaman->all();
    }

    public function getRiwayatByAnggota($id_anggota) {
        return $this->peminjaman->findByAnggota($id_anggota);
    }

    /* =====================
       HAPUS DATA PEMINJAMAN
    ===================== */
    public function hapus($id_peminjaman) {
        return $this->peminjaman->hapus($id_peminjaman);
    }
}
