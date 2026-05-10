<?php include '../layout/header.php'; ?>

<main class="auth">
    <div class="form-container">
        <h2>Daftar Akun</h2>
        <form action="/handlers/auth_handler.php" method="POST">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="/login">Login</a></p>
    </div>
</main>

<?php include '../layout/footer.php'; ?>
