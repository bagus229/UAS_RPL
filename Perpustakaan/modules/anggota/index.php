<style>
    /* ===============================
   PAGE
================================ */
body {
    background: #f1f5f9;
    font-family: Arial, sans-serif;
    font-size: 14px;
    padding: 20px;
}

/* ===============================
   TITLE
================================ */
h2 {
    margin-bottom: 15px;
    color: #111827;
}

/* ===============================
   BUTTON
================================ */
.btn {
    display: inline-block;
    padding: 7px 14px;
    border-radius: 8px;
    border: none;
    background: #111827;
    color: #ffffff;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
    margin-right: 5px;
}

.btn:hover {
    opacity: 0.9;
}

.btn-success {
    background: #16a34a;
}

.btn-danger {
    background: #dc2626;
}

/* ===============================
   TABLE
================================ */
table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 10px;
    overflow: hidden;
}

table th {
    background: #111827;
    color: #ffffff;
    padding: 10px;
    font-size: 13px;
}

table td {
    padding: 9px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 13px;
}

table tr:hover {
    background: #f8fafc;
}

/* ===============================
   ACTION LINKS
================================ */
.action-link {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}

.action-link:hover {
    text-decoration: underline;
}

.action-delete {
    color: #dc2626;
}

</style>
<?php
// role user
$role = $_SESSION['role'] ?? 'user';
?>

<h2>Master Anggota</h2>

<a href="<?= BASE_URL ?>/dashboard"><button>Kembali</button></a>


<?php if ($role === 'admin'): ?>
    <!-- HANYA ADMIN -->
    <a href="<?= BASE_URL ?>/anggota/create"><button>Tambah Anggota</button></a> 
<?php endif; ?>

<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>Nama</th>
    <th>Alamat</th>
    <th>No HP</th>

    <?php if ($role === 'admin'): ?>
        <th>Aksi</th>
    <?php endif; ?>
</tr>

<?php while ($a = $data->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($a['nama']) ?></td>
    <td><?= htmlspecialchars($a['alamat']) ?></td>
    <td><?= htmlspecialchars($a['telepon']) ?></td>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <td>
            <a href="<?= BASE_URL ?>/anggota/edit/<?= $a['id_anggota'] ?>">Edit</a> |
            <a href="<?= BASE_URL ?>/anggota/delete/<?= $a['id_anggota'] ?>"
               onclick="return confirm('Yakin hapus anggota ini?')">
               Hapus
            </a>
        </td>
    <?php endif; ?>
</tr>
<?php endwhile; ?>

</table>
