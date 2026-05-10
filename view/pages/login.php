<?php include '../layout/header.php'; ?>

<main class="auth">
    <div class="form-container">
        <h2>Login</h2>
        <form action="/handlers/auth_handler.php" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Belum punya akun? <a href="/register">Daftar</a></p>
        <p><a href="/forgot_password">Lupa Password?</a></p>
    </div>
</main>

<?php include '../layout/footer.php'; ?>
