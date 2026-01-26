<?php
require_once __DIR__ . '/../models/Laporan.php';

class LaporanController {
    private $laporan;

    public function __construct() {
        $this->laporan = new Laporan();
    }

    public function index() {
        $data = $this->laporan->getAll();
        include __DIR__ . '/../modules/laporan/index.php';
    }

    public function riwayatUser($id_anggota) {
        $data = $this->laporan->getRiwayatByAnggota($id_anggota);
        include __DIR__ . '/../modules/laporan/index.php';
    }

    public function hapus() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Akses ditolak!");
        }

        if (!isset($_POST['id_peminjaman'])) {
            die("ID peminjaman tidak ditemukan!");
        }

        $this->laporan->hapus($_POST['id_peminjaman']);

        header("Location: " . BASE_URL . "/laporan");
        exit;
    }
}