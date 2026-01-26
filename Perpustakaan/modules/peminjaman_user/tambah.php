<style>
    body {
        background: #f1f5f9;
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 20px;
        display: grid;
        align-items: center;    
        justify-content: center;
    }

    h2 {
        margin-bottom: 15px;
        color: #111827;
        text-align: center;
    }

    form {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        max-width: 500px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    label {
        display: block;
        margin-top: 12px;
        font-size: 13px;
        font-weight: 500;
    }

    input[type="date"],
    select {
        width: 100%;
        height: 40px;
        margin-top: 6px;
        padding: 6px 10px;
        font-size: 13px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
    }

    input[type="date"]:focus,
    select:focus {
        outline: none;
        border-color: #111827;
    }

    button {
        margin-top: 18px;
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        background: #111827;
        color: #ffffff;
        font-size: 13px;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.9;
    }

    .btn-secondary {
        background: #64748b;
    }

    .form-actions {
        margin-top: 15px;
    }
</style>

<form action="<?= BASE_URL ?>/peminjaman_user/store" method="POST">
<h2>Form Peminjaman</h2><br>

    <label>Anggota:</label>
    <select name="id_anggota" required>
        <?php while($a = $anggota_list->fetch_assoc()): ?>
            <option value="<?= $a['id_anggota'] ?>"><?= $a['nama'] ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Buku:</label>
    <?php while ($b = $buku_list->fetch_assoc()): ?>
        <?php if ($b['stok'] > 0): ?>
            <label style="display:block; margin-bottom:4px;">
                <input type="checkbox"
                       name="id_buku[]"
                       value="<?= $b['id_buku'] ?>">
                <?= htmlspecialchars($b['judul']) ?>
                (stok: <?= $b['stok'] ?>)
            </label>
        <?php endif; ?>
    <?php endwhile; ?>

    <label>Tanggal Pinjam:</label>
    <input type="date" name="tgl_pinjam" value="<?= date('Y-m-d') ?>" required><br>

    <label>Tanggal Kembali:</label>
    <input type="date" name="tgl_kembali" value="<?= date('Y-m-d') ?>" required><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= BASE_URL ?>/peminjaman_user"><button type="button">Kembali</button></a>
</form>
