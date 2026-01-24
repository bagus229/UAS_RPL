<style>
    /* ===============================
   PAGE
================================ */
body {
    background: #f8fafc;
    font-family: Arial, sans-serif;
    font-size: 14px;
    padding: 20px;
}

/* ===============================
   TITLE
================================ */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #111827;
}

/* ===============================
   FORM CONTAINER
================================ */
form {
    width: 450px;
    margin: 0 auto;               /* TENGAH */
    background: #ffffff;
    padding: 22px 26px;
    border-radius: 12px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.08);
}

/* ===============================
   LABEL & INPUT
================================ */
label {
    display: block;
    margin-top: 12px;
    margin-bottom: 4px;
    font-weight: 600;
    color: #374151;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 8px 10px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
}

input:focus {
    outline: none;
    border-color: #2563eb;
}

/* ===============================
   IMAGE PREVIEW
================================ */
img {
    display: block;
    margin: 10px auto;
    border-radius: 6px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.15);
}

small {
    display: block;
    text-align: center;
    color: #6b7280;
}

/* ===============================
   BUTTON
================================ */
button {
    padding: 8px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 14px;
}

button[type="submit"] {
    background: #2563eb;
    color: #ffffff;
}

a button {
    background: #6b7280;
    color: #ffffff;
    margin-left: 6px;
}

button:hover {
    opacity: 0.9;
}

</style>
<h2>Edit Buku</h2>

<form action="<?= BASE_URL ?>/buku/update/<?= $buku['id_buku'] ?>"
      method="POST"
      enctype="multipart/form-data">

    <!-- SIMPAN GAMBAR LAMA -->
    <input type="hidden" name="gambar_lama" value="<?= $buku['gambar'] ?>">

    <label>Judul:</label>
    <input type="text" name="judul" value="<?= $buku['judul'] ?>" required><br>

    <label>Pengarang:</label>
    <input type="text" name="pengarang" value="<?= $buku['pengarang'] ?>"><br>

    <label>Penerbit:</label>
    <input type="text" name="penerbit" value="<?= $buku['penerbit'] ?>"><br>

    <label>Tahun:</label>
    <input type="number" name="tahun" value="<?= $buku['tahun'] ?>"><br>

    <label>Stok:</label>
    <input type="number" name="stok" value="<?= $buku['stok'] ?>" required><br>

    <label>Gambar:</label>
    <input type="file" name="gambar"><br>

    <?php if (!empty($buku['gambar'])): ?>
        <br>
        <img src="<?= BASE_URL ?>/assets/gambar/<?= $buku['gambar'] ?>"
             width="120"
             alt="Gambar Buku">
        
    <?php endif; ?>

    <br><br>

    <button type="submit">Update</button>
    <a href="<?= BASE_URL ?>/buku"><button type="button">Batal</button></a>
</form>
