<style>
    body {
        background: #f1f5f9;
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 20px;
    }

    h2 {
        margin-bottom: 15px;
        color: #0c0d0e;
    }

    .alert {
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    .alert-error {
        background: #fee2e2;
        color: #7f1d1d;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .btn {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 8px;
        border: none;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        background: #111827;
        color: #fff;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-danger {
        background: #dc2626;
    }

    .btn-secondary {
        background: #64748b;
    }

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

    .form-inline {
        display: inline;
    }

    .form-inline input[type="date"] {
        height: 32px;
        padding: 4px 6px;
        font-size: 12px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        margin-right: 4px;
    }

    .status {
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-menunggu {
        color: #ca8a04;
    }

    .status-dipinjam {
        color: #2563eb;
    }

    .status-dikembalikan {
        color: #16a34a;
    }
</style>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>


<h2>Tabel Peminjaman dan Pengembalian</h2>

<br>

<a href="<?= BASE_URL ?>/peminjaman_user/create"><button>Pinjam Buku</button></a>
<a href="<?= BASE_URL ?>/dashboard"><button>Kembali</button></a>

<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>Nama Peminjam</th>
    <th>Judul Buku</th>
    <th>Tgl Pinjam</th>
    <th>Tgl Kembali</th>
    <th>Status</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php if ($data && $data->num_rows > 0): ?>
<?php while ($p = $data->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($p['nama_anggota']) ?></td>
    <td><?= htmlspecialchars($p['judul']) ?></td>
    <td><?= $p['tgl_pinjam'] ?></td>
    <td><?= $p['tgl_kembali'] ?: '-' ?></td>
    <td><?= ucfirst($p['status']) ?></td>
    <td>Rp <?= number_format($p['denda'], 0, ',', '.') ?></td>

    <td>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

        <?php if ($p['status'] === 'menunggu'): ?>

            <form action="<?= BASE_URL ?>/peminjaman_user/setujui" method="POST" style="display:inline;">
                <input type="hidden" name="id_peminjaman" value="<?= $p['id_peminjaman'] ?>">
                <button type="submit">Setujui</button>
            </form>

            <form action="<?= BASE_URL ?>/peminjaman_user/tolak" method="POST" style="display:inline;"
                  onsubmit="return confirm('Yakin menolak peminjaman ini?');">
                <input type="hidden" name="id_peminjaman" value="<?= $p['id_peminjaman'] ?>">
                <button type="submit" style="color:red;">Tolak</button>
            </form>

        <?php elseif ($p['status'] === 'dipinjam'): ?>

            <form action="<?= BASE_URL ?>/peminjaman_user/kembali" method="POST" style="display:inline;">
                <input type="hidden" name="id_peminjaman" value="<?= $p['id_peminjaman'] ?>">
                <input type="date" name="tgl_kembali" value="<?= date('Y-m-d') ?>" required>
                <button type="submit">Kembalikan</button>
            </form>

        <?php endif; ?>

        <form action="<?= BASE_URL ?>/peminjaman_user/hapus" method="POST" style="display:inline;"
              onsubmit="return confirm('Yakin hapus data?');">
            <input type="hidden" name="id_peminjaman" value="<?= $p['id_peminjaman'] ?>">
            <button type="submit" style="color:red;">Hapus</button>
        </form>

    <?php else: ?>
        <em><?= ucfirst($p['status']) ?></em>
    <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="7" align="center">Belum ada data peminjaman</td>
</tr>
<?php endif; ?>
</table>
