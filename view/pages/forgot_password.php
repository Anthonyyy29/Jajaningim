<main class="auth">
    <div class="form-container">
        <h2>Lupa Password</h2>
        <form action="/handlers/auth_handler.php" method="POST">
            <input type="hidden" name="action" value="forgot_password">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn">Kirim Reset Link</button>
        </form>
        <p><a href="/login">Kembali ke Login</a></p>
    </div>
</main>
