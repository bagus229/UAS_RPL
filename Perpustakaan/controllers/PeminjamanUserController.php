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

    public function index() {
        $data = $this->peminjaman->all();
        include __DIR__ . '/../modules/peminjaman_user/index.php';
    }

    public function create() {
        $buku_list    = $this->peminjaman->getBuku();
        $anggota_list = $this->peminjaman->getAnggota();
        include __DIR__ . '/../modules/peminjaman_user/tambah.php';
    }

    public function store() {
        $id_anggota = $_POST['id_anggota'] ?? ($_SESSION['id_anggota'] ?? null);
        $buku_ids   = $_POST['id_buku'] ?? [];
        $tgl_pinjam = $_POST['tgl_pinjam'] ?? date('Y-m-d');

        if (count($buku_ids) == 0) {
            $_SESSION['error'] = "Buku belum dipilih!";
            header("Location: " . BASE_URL . "/peminjaman_user/create");
            exit;
        }

        if (count($buku_ids) > 10) {
            $_SESSION['error'] = "Maksimal peminjaman 10 buku!";
            header("Location: " . BASE_URL . "/peminjaman_user/create");
            exit;
        }

        foreach ($buku_ids as $id_buku) {
            $result = $this->peminjaman->create(
                $id_anggota,
                $id_buku,
                $tgl_pinjam
            );

            if ($result['status'] === false) {
                $_SESSION['error'] = $result['message'];
                header("Location: " . BASE_URL . "/peminjaman_user/create");
                exit;
            }
        }

        $_SESSION['success'] = "Peminjaman berhasil disimpan";
        header("Location: " . BASE_URL . "/peminjaman_user");
        exit;
    }

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
