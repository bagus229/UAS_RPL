<style>
    body {
        background: #f8fafc;
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
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

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

    button {
        padding: 8px 16px;
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

<h2>Tambah Buku</h2>

<form action="<?= BASE_URL ?>/buku/store"
      method="POST"
      enctype="multipart/form-data">

    <label>Judul:</label>
    <input type="text" name="judul" required><br>

    <label>Pengarang:</label>
    <input type="text" name="pengarang"><br>

    <label>Penerbit:</label>
    <input type="text" name="penerbit"><br>

    <label>Tahun:</label>
    <input type="number" name="tahun"><br>

    <label>Stok:</label>
    <input type="number" name="stok" required><br>

    <label>Gambar:</label>
    <input type="file" name="gambar"><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= BASE_URL ?>/buku"><button type="button">Kembali</button></a>
</form>
