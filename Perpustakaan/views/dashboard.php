<style>
    body {
    background: #f1f5f9;
    font-family: Arial, sans-serif;
    padding: 20px;
    }

    .container {
        max-width: 1100px;
        margin: auto;
    }

    header {
        background: #111827;
        color: #fff;
        padding: 20px;
        border-radius: 12px;
    }

    nav {
        margin-top: 20px;
        background: #ffffff;
        padding: 15px;
        border-radius: 10px;
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 15px;
    }

    nav a {
        text-decoration: none;
        padding: 8px 14px;
        background: #e5e7eb;
        border-radius: 8px;
        color: #111827;
    }

    nav a:hover {
        background: #111827;
        color: #fff;
    }

    footer {
        margin-top: 30px;
        text-align: center;
    }
</style>

<?php
if (!isset($_SESSION['role'])) {
    header("Location: " . BASE_URL . "/login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Perpustakaan</title>

</head>
<body>
    <div class="container">
        <header>
            <h2>Selamat Datang Di Aplikasi Sistem Perpustakaan</h2>
            <p>
                Login sebagai: 
                <strong><?= $_SESSION['nama'] ?></strong> 
                (<?= $_SESSION['role'] ?>)
            </p>
        </header>

        <br>  

        <nav>
            <p><b>Pilihan Menu:</b></p><hr>
            <ul>
                <li><a href="<?= BASE_URL ?>/buku">📚 Master Buku</a></li>
                <li><a href="<?= BASE_URL ?>/anggota">👥 Master Anggota</a></li>
                <li><a href="<?= BASE_URL ?>/peminjaman_user">📝 Peminjaman Buku</a></li>
                <li><a href="<?= BASE_URL ?>/laporan">📄 Laporan</a></li>
            </ul>
        </nav>
        <br>

        <footer>
            <a href="<?= BASE_URL ?>/logout" onclick="return confirm('Yakin logout?')">
                <button>Logout</button>
            </a>
        </footer>
    </div>
</body>
</html>
