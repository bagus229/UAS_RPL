<style>
    body {
        background: linear-gradient(120deg, #eef2f7, #f8fafc);
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 20px;
    }

    .container {
        width: 380px;
        margin: 100px auto;        
        background: #ffffff;
        padding: 25px 30px;
        border-radius: 14px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        text-align: center;
    }

    .container h2 {
        margin-bottom: 20px;
        color: #111827;
    }

    .container p {
        color: #dc2626;
        margin-bottom: 15px;
        font-size: 13px;
    }

    form input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
    }

    form input:focus {
        outline: none;
        border-color: #2563eb;
    }

    form button {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: none;
        background: #2563eb;
        color: #ffffff;
        font-size: 14px;
        cursor: pointer;
    }

    form button:hover {
        opacity: 0.9;
    }

    a button {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        border-radius: 10px;
        border: none;
        background: #6b7280;
        color: #ffffff;
        cursor: pointer;
    }

    a button:hover {
        opacity: 0.9;
    }
</style>

<div class="container">
    <h2>Login</h2>

    <?php if(isset($_SESSION['error'])): ?>
    <p style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <br>

    <a href="<?= BASE_URL ?>/register">
        <button>Daftar Akun</button>
    </a>
</div>
