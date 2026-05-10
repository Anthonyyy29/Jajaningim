<div class="auth-split">

  <div class="auth-left">
    <span class="deco circle circle1"></span>
    <span class="deco circle circle2"></span>
    <span class="deco circle circle3"></span>
    <span class="deco spark spark1">✦</span>
    <span class="deco spark spark2">✦</span>
    <span class="deco lightning lightning1">⚡</span>

    <div class="auth-left-content">
      <img src="/assets/logo_jajaningim/logo.png" class="auth-logo">
      <h1>Lupa password?<br>Tenang aja!</h1>
      <p>Kami akan bantu kamu masuk kembali.</p>
    </div>
  </div>

  <div class="auth-right">
    <h2>Reset Password</h2>
    <p class="auth-subtitle">Masukkan email yang terdaftar untuk mereset password kamu</p>

    <form action="/app/handlers/request.php" method="POST">
      <input type="hidden" name="action" value="forgot_password">

      <label>Email</label>
      <div class="input-box">
        <img src="/add_rivan/registerpage/asset_registrasi/email.png" class="icon-left">
        <input type="email" name="email" placeholder="Masukkan email" required>
      </div>

      <button type="submit" class="auth-btn">Kirim Reset Link</button>
    </form>

    <p class="auth-link"><a href="/?url=login">← Kembali ke Login</a></p>
  </div>
</div>
