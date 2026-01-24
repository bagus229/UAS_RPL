<style>
    /* ===============================
   PAGE
================================ */
body {
    background: #f1f5f9;
    font-family: Arial, sans-serif;
    font-size: 14px;
    padding: 20px;
    display: grid;
    align-items: center;     /* tengah vertikal */
    justify-content: center;
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
   FORM WRAPPER
================================ */
form {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    max-width: 500px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* ===============================
   LABEL
================================ */
label {
    display: block;
    margin-top: 12px;
    font-size: 13px;
    font-weight: 500;
}

/* ===============================
   INPUT & SELECT
================================ */
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

/* ===============================
   BUTTON
================================ */
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

/* ===============================
   ACTION AREA
================================ */
.form-actions {
    margin-top: 15px;
}

</style>
<form action="<?= BASE_URL ?>/peminjaman_user/store" method="POST">
<h2>Form Peminjaman</h2><br>
    <!-- Pilih Anggota -->
    <label>Anggota:</label>
    <select name="id_anggota" required>
        <?php while($a = $anggota_list->fetch_assoc()): ?>
            <option value="<?= $a['id_anggota'] ?>"><?= $a['nama'] ?></option>
        <?php endwhile; ?>
    </select><br>

    <!-- Pilih Buku -->
    <label>Buku:</label>
    <select name="id_buku" required>
        <?php while($b = $buku_list->fetch_assoc()): ?>
            <option value="<?= $b['id_buku'] ?>"><?= $b['judul'] ?> (Stok: <?= $b['stok'] ?>)</option>
        <?php endwhile; ?>
    </select><br>

    <!-- Tanggal Pinjam -->
    <label>Tanggal Pinjam:</label>
    <input type="date" name="tgl_pinjam" value="<?= date('Y-m-d') ?>" required><br>

    <!-- Tanggal Kembali -->
    <label>Tanggal Kembali:</label>
    <input type="date" name="tgl_kembali" value="<?= date('Y-m-d') ?>" required><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= BASE_URL ?>/peminjaman_user"><button type="button">Kembali</button></a>

</form>
