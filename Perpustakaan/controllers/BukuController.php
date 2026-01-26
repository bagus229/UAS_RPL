<?php
require_once __DIR__ . '/../models/Buku.php';

class BukuController {

    private $buku;

    public function __construct() {
        $this->buku = new Buku();
    }

    private function onlyAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            die("Akses ditolak!");
        }
    }

    public function index() {
        $limit = 10;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        if ($halaman < 1) $halaman = 1;

        $offset = ($halaman - 1) * $limit;
        $search = $_GET['search'] ?? '';

        if ($search) {
            $data = $this->buku->searchPaginate($search, $limit, $offset);
            $total_data = $this->buku->countSearch($search);
        } else {
            $data = $this->buku->paginate($limit, $offset);
            $total_data = $this->buku->countData();
        }

        $total_page = ceil($total_data / $limit);
        include __DIR__ . '/../modules/buku/index.php';
    }

    public function create() {
        $this->onlyAdmin();
        include __DIR__ . '/../modules/buku/tambah.php';
    }

    public function store() {
        $this->onlyAdmin();

        $judul     = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit  = $_POST['penerbit'];
        $tahun     = $_POST['tahun'];
        $stok      = $_POST['stok'];

        $gambar = null;

        if (!empty($_FILES['gambar']['name'])) {
            $dir = __DIR__ . '/../assets/gambar/';
            if (!is_dir($dir)) mkdir($dir, 0777, true);

            $filename = time() . '_' . basename($_FILES['gambar']['name']);
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $filename)) {
                $gambar = $filename;
            }
        }

        $this->buku->insert($judul, $pengarang, $penerbit, $tahun, $stok, $gambar);
        header("Location: " . BASE_URL . "/buku");
        exit;
    }

    public function edit($id) {
        $this->onlyAdmin();
        $buku = $this->buku->find($id);
        include __DIR__ . '/../modules/buku/edit.php';
    }

    public function update($id) {
        $this->onlyAdmin();

        $gambar = $_POST['gambar_lama'];

        if (!empty($_FILES['gambar']['name'])) {
            $dir = __DIR__ . '/../assets/gambar/';
            if (!is_dir($dir)) mkdir($dir, 0777, true);

            $filename = time() . '_' . basename($_FILES['gambar']['name']);
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $filename)) {

                if ($gambar && file_exists($dir . $gambar)) {
                    unlink($dir . $gambar);
                }

                $gambar = $filename;
            }
        }

        $this->buku->update(
            $id,
            $_POST['judul'],
            $_POST['pengarang'],
            $_POST['penerbit'],
            $_POST['tahun'],
            $_POST['stok'],
            $gambar
        );

        header("Location: " . BASE_URL . "/buku");
        exit;
    }

    public function delete($id) {
        $this->onlyAdmin();
        $this->buku->delete($id);
        header("Location: " . BASE_URL . "/buku");
        exit;
    }
}
