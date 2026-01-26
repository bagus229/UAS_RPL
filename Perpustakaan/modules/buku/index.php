<style>
    body {
        background: #f8fafc;
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 20px;
    }

    h2 {
        margin-bottom: 15px;
        color: #111827;
    }

    form {
        margin-bottom: 10px;
    }

    form input[type="text"] {
        padding: 6px 10px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        width: 220px;
    }

    form button {
        padding: 6px 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        background: #2563eb;
        color: #ffffff;
    }

    button {
        padding: 7px 14px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 13px;
        margin-right: 5px;
    }

    button:disabled {
        background: #9ca3af;
        cursor: not-allowed;
    }

    a button {
        background: #111827;
        color: #ffffff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
    }

    table th {
        background: #1f2933;
        color: #ffffff;
        padding: 10px;
    }

    table td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
    }

    table tr:hover {
        background: #f1f5f9;
    }

    table img {
        border-radius: 6px;
        object-fit: cover;
    }

    table a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }

    table a:hover {
        text-decoration: underline;
    }

    .pagination {
        margin-top: 15px;
    }

    .pagination a button {
        background: #e5e7eb;
        color: #111827;
    }

    .pagination a button:disabled {
        background: #2563eb;
        color: #ffffff;
    }
</style>
<h2>Data Buku</h2>

<form method="GET" action="">
    <input type="hidden" name="page" value="buku">
    <input type="text" name="search" placeholder="Cari judul / pengarang"
           value="<?= $_GET['search'] ?? '' ?>">
    <button type="submit">Cari</button>
</form>

<br>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="<?= BASE_URL ?>/buku/create">
        <button>Tambah Buku</button>
    </a>
<?php endif; ?>

<a href="<?= BASE_URL ?>/dashboard">
    <button>Kembali</button>
</a>

<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>Gambar</th>
    <th>Judul</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Tahun</th>
    <th>Stok</th>
    <?php if ($_SESSION['role'] === 'admin'): ?><th>Aksi</th><?php endif; ?>
</tr>

<?php foreach ($data as $d): ?>
<tr>
    <td>
        <img src="<?= BASE_URL ?>/assets/gambar/<?= $d['gambar'] ?: 'default.png' ?>" width="50">
    </td>
    <td><?= htmlspecialchars($d['judul']) ?></td>
    <td><?= htmlspecialchars($d['pengarang']) ?></td>
    <td><?= htmlspecialchars($d['penerbit']) ?></td>
    <td><?= $d['tahun'] ?></td>
    <td><?= $d['stok'] ?></td>

    <?php if ($_SESSION['role'] === 'admin'): ?>
    <td>
        <a href="<?= BASE_URL ?>/buku/edit/<?= $d['id_buku'] ?>">Edit</a> |
        <a href="<?= BASE_URL ?>/buku/delete/<?= $d['id_buku'] ?>"
           onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>
</table>

<br>

<?php
$halamanAktif = $_GET['halaman'] ?? 1;
$search = $_GET['search'] ?? '';
?>

<div class="pagination">
<?php for ($i = 1; $i <= $total_page; $i++): ?>
    <a href="?page=buku&search=<?= urlencode($search) ?>&halaman=<?= $i ?>">
        <button <?= ($i == $halamanAktif) ? 'disabled' : '' ?>>
            <?= $i ?>
        </button>
    </a>
<?php endfor; ?>
</div>

