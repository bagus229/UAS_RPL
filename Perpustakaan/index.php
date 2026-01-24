<?php
session_start();
define('BASE_URL', 'http://localhost/perpustakaan');
define('BASE_PATH', __DIR__);

// LOAD CONFIG & CONTROLLERS
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/BukuController.php';
require_once __DIR__ . '/controllers/AnggotaController.php';
require_once __DIR__ . '/controllers/LaporanController.php';
require_once __DIR__ . '/controllers/PeminjamanUserController.php';

// AMBIL URL
$url = $_GET['url'] ?? 'login';
$url = explode('/', $url);

// ROUTING UTAMA
switch ($url[0]) {

    case 'login':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new AuthController)->loginProcess();
    } else {
        (new AuthController)->login();
    }
    break;

case 'register':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new AuthController)->registerProcess();
    } else {
        (new AuthController)->register();
    }
    break;

    case 'logout':
        (new AuthController)->logout();
        break;

    case 'dashboard':
        (new DashboardController())->index();
        break;

    case 'buku':
        $ctrl = new BukuController();
        switch ($url[1] ?? '') {
            case 'create': $ctrl->create(); break;
            case 'store':  $ctrl->store(); break;
            case 'setujui':  $ctrl->setujui(); break;
            case 'kembali':  $ctrl->kembali(); break;
            case 'edit':   $ctrl->edit($url[2] ?? null); break;
            case 'update': $ctrl->update($url[2] ?? null); break;
            case 'delete': $ctrl->delete($url[2] ?? null); break;
            default: $ctrl->index();
        }
        break;

    case 'anggota':
        $ctrl = new AnggotaController();
        switch ($url[1] ?? '') {
            case 'create': $ctrl->create(); break;
            case 'store':  $ctrl->store(); break;
            case 'edit':   $ctrl->edit($url[2] ?? null); break;
            case 'update': $ctrl->update($url[2] ?? null); break;
            case 'delete': $ctrl->delete($url[2] ?? null); break;
            default: $ctrl->index();
        }
        break;

    case 'peminjaman_user':
    $ctrl = new PeminjamanUserController();
    switch ($url[1] ?? '') {
        case 'create':  $ctrl->create(); break;
        case 'store':   $ctrl->store(); break;
        case 'setujui':  $ctrl->setujui(); break;
        case 'tolak':  $ctrl->tolak(); break;
        case 'kembali': $ctrl->kembali(); break;
        case 'hapus':   $ctrl->hapus(); break;
        default:        $ctrl->index();
    }
    break;

    
        

    case 'laporan':
        $id_anggota = $_GET['id_anggota'] ?? 0;
        (new LaporanController())->index($id_anggota);
        break;

    default:
        header("Location: " . BASE_URL . "/dashboard");
        exit;
}
