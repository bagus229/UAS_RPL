<?php
require_once __DIR__ . '/../models/Peminjaman.php';
require_once __DIR__ . '/../models/Buku.php';

class PeminjamanUserController {
    private $peminjaman;
    private $buku;

    public function __construct() {
        $this->peminjaman = new Peminjaman();
        $this->buku = new Buku();
    }

    // =====================
    // TAMPILKAN DATA
    // =====================
    public function index() {
        $data = $this->peminjaman->all();
        include __DIR__ . '/../modules/peminjaman_user/index.php';
    }

    // =====================
    // FORM TAMBAH
    // =====================
    public function create() {
        $buku_list    = $this->peminjaman->getBuku();
        $anggota_list = $this->peminjaman->getAnggota();
        include __DIR__ . '/../modules/peminjaman_user/tambah.php';
    }

    // =====================
    // SIMPAN PEMINJAMAN
    // =====================
    public function store() {
        $id_anggota = $_POST['id_anggota'] ?? ($_SESSION['id_anggota'] ?? null);
        $id_buku    = $_POST['id_buku'] ?? null;
        $tgl_pinjam = $_POST['tgl_pinjam'] ?? date('Y-m-d');

        if (!$id_buku) {
            $_SESSION['error'] = "Buku belum dipilih!";
            header("Location: " . BASE_URL . "/peminjaman_user/create");
            exit;
        }

        $result = $this->peminjaman->create($id_anggota, $id_buku, $tgl_pinjam);

        if ($result['status'] === false) {
            $_SESSION['error'] = $result['message'];
            header("Location: " . BASE_URL . "/peminjaman_user/create");
            exit;
        }

        $_SESSION['success'] = $result['message'];
        header("Location: " . BASE_URL . "/peminjaman_user");
        exit;
    }

    // =====================
    // KEMBALIKAN (ADMIN ONLY)
    // =====================
    public function kembali() {

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Akses ditolak! Hanya admin yang bisa mengembalikan buku.");
        }

        if (!isset($_POST['id_peminjaman'])) {
            die("ID peminjaman tidak valid!");
        }

        $id_peminjaman = $_POST['id_peminjaman'];
        $tgl_kembali   = $_POST['tgl_kembali'] ?? date('Y-m-d');

        $this->peminjaman->kembali($id_peminjaman, $tgl_kembali);

        $_SESSION['success'] = "Buku berhasil dikembalikan";
        header("Location: " . BASE_URL . "/peminjaman_user");
        exit;
    }

    // =====================
    // HAPUS (ADMIN ONLY)
    // =====================
    public function hapus() {

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Akses ditolak!");
        }

        if (!isset($_POST['id_peminjaman'])) {
            die("ID peminjaman tidak ditemukan!");
        }

        $this->peminjaman->hapus($_POST['id_peminjaman']);

        $_SESSION['success'] = "Data peminjaman dihapus";
        header("Location: " . BASE_URL . "/peminjaman_user");
        exit;
    }

    public function setujui() {

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die("Akses ditolak!");
    }

    if (!isset($_POST['id_peminjaman'])) {
        die("ID peminjaman tidak ditemukan!");
    }

    $this->peminjaman->setujui($_POST['id_peminjaman']);

    $_SESSION['success'] = "Peminjaman disetujui";
    header("Location: " . BASE_URL . "/peminjaman_user");
    exit;
}
    public function tolak() {

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die("Akses ditolak!");
    }

    if (!isset($_POST['id_peminjaman'])) {
        die("ID peminjaman tidak ditemukan!");
    }

    $this->peminjaman->tolak($_POST['id_peminjaman']);

    $_SESSION['success'] = "Peminjaman ditolak";
    header("Location: " . BASE_URL . "/peminjaman_user");
    exit;
}


}
