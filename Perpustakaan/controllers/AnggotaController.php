<?php
require_once __DIR__ . '/../models/Anggota.php';

class AnggotaController {

    private $anggota;

    public function __construct() {
        $this->anggota = new Anggota();
    }

    public function index() {
        $data = $this->anggota->all();
        include __DIR__ . '/../modules/anggota/index.php';
    }

    public function create() {
        include __DIR__ . '/../modules/anggota/tambah.php';
    }

    public function store() {
        if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['telepon'])) {
            die("Data tidak lengkap!");
        }

        $this->anggota->create(
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['telepon']
        );

        header("Location: " . BASE_URL . "/anggota");
        exit;
    }

    public function edit($id) {
        if (!$id) die("ID tidak ditemukan");

        $anggota = $this->anggota->find($id);
        include __DIR__ . '/../modules/anggota/edit.php';
    }

    public function update($id) {
        if (!$id) die("ID tidak ditemukan");

        if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['telepon'])) {
            die("Data tidak lengkap!");
        }

        $this->anggota->update(
            $id,
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['telepon']
        );

        header("Location: " . BASE_URL . "/anggota");
        exit;
    }

    public function delete($id) {
        if (!$id) die("ID tidak ditemukan");

        $this->anggota->delete($id);

        header("Location: " . BASE_URL . "/anggota");
        exit;
    }
}
