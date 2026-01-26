<style>
    body {
        background: #f1f5f9;
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 20px;
    }
    
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #111827;
    }
    
    form {
        width: 420px;
        margin: 0 auto; 
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    table td {
        padding: 8px 5px;
        vertical-align: top;
    }
    
    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        font-size: 13px;
    }
    
    textarea {
        resize: vertical;
        min-height: 70px;
    }
    
    button {
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 13px;
    }
    
    button[type="submit"] {
        background: #111827;
        color: #ffffff;
    }
    
    button[type="button"] {
        background: #111827;
        color: #ffffff;
        margin-left: 8px;
    }
    
    button:hover {
        opacity: 0.9;
    }
</style>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<h3>Akses ditolak</h3>";
    exit;
}

if (!$anggota) {
    echo "<h3>Data anggota tidak ditemukan</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
</head>
<body>
    <form method="POST" action="<?= BASE_URL ?>/anggota/update/<?= $anggota['id_anggota'] ?>">
    <h2>Edit Anggota</h2>
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="nama"
                           value="<?= htmlspecialchars($anggota['nama']) ?>" required>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <textarea name="alamat" required><?= htmlspecialchars($anggota['alamat']) ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>
                    <input type="text" name="telepon"
                           value="<?= htmlspecialchars($anggota['telepon']) ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Update</button>
                    <a href="<?= BASE_URL ?>/anggota"><button>Kembali</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
