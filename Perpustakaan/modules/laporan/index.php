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
    text-align: center;
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
}

.btn:hover {
    opacity: 0.9;
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
    margin-top: 15px;
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
   FORM
================================ */
form {
    display: inline;
}

/* ===============================
   EMPTY DATA
================================ */
td[colspan] {
    text-align: center;
    font-style: italic;
    color: #6b7280;
}

</style>
<h2>Laporan Peminjaman</h2><br>
<a href="<?= BASE_URL ?>/dashboard"><button>Kembali</button></a>

<br>

<table border="1" cellpadding="5">
<tr>
    <th>Nama Peminjam</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th>Status</th>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <th>Aksi</th>
    <?php endif; ?>
</tr>

<?php if ($data && $data->num_rows > 0): ?>
<?php while ($r = $data->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($r['nama_anggota'] ?? '-') ?></td>
    <td><?= htmlspecialchars($r['judul']) ?></td>
    <td><?= $r['tgl_pinjam'] ?></td>
    <td><?= !empty($r['tgl_kembali']) ? $r['tgl_kembali'] : '-' ?></td>
    <td>Rp <?= number_format($r['denda'] ?? 0, 0, ',', '.') ?></td>
    <td><?= $r['status'] ?></td>

    <?php if ($_SESSION['role'] === 'admin'): ?>
    <td>
        <form action="<?= BASE_URL ?>/laporan/hapus" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
            <input type="hidden" name="id_peminjaman" value="<?= $r['id_peminjaman'] ?>">
            <button type="submit" style="color:red;">Hapus</button>
        </form>
    </td>
    <?php endif; ?>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="<?= $_SESSION['role'] === 'admin' ? 7 : 6 ?>" align="center">
        Tidak ada data peminjaman
    </td>
</tr>
<?php endif; ?>
</table>
