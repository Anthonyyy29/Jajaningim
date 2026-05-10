<?php
$error   = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<div class="auth-split">

  <div class="auth-left">
    <span class="deco circle circle1"></span>
    <span class="deco circle circle2"></span>
    <span class="deco circle circle3"></span>
    <span class="deco spark spark1">✦</span>
    <span class="deco spark spark2">✦</span>
    <span class="deco spark spark3">✦</span>
    <span class="deco lightning lightning1">⚡</span>
    <span class="deco lightning lightning2">⚡</span>

    <div class="auth-left-content">
      <img src="/assets/logo_jajaningim/logo.png" class="auth-logo">
      <h1>Belanja game<br>favoritmu sekarang!</h1>
      <p>Top up cepat dan harga bersahabat.</p>
      <div class="promo-box">
        <img src="/add_rivan/loginpage/asset_Login/hadiah.png" class="gift">
        <p>Nikmati kemudahan top up<br>game favoritmu hanya di<br><b>Jajanin Gim</b></p>
      </div>
    </div>
  </div>

  <div class="auth-right">
    <h2>Masuk Akun</h2>
    <p class="auth-subtitle">Login untuk mulai top up dan belanja game di Jajanin Gim</p>

    <?php if ($error === 'invalid'): ?>
      <div class="auth-alert">Username atau password salah!</div>
    <?php endif; ?>
    <?php if ($success === 'registered'): ?>
      <div class="auth-success">Registrasi berhasil! Silakan login.</div>
    <?php endif; ?>

    <form action="/app/handlers/request.php" method="POST" autocomplete="off">
      <input type="hidden" name="action" value="login">

      <label>Username</label>
      <div class="input-box">
        <img src="/add_rivan/loginpage/asset_Login/user.png" class="icon-left">
        <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
      </div>

      <label>Password</label>
      <div class="input-box">
        <img src="/add_rivan/loginpage/asset_Login/lock.png" class="icon-left">
        <input type="password" name="password" id="loginPassword" placeholder="Masukkan password" required autocomplete="new-password">
        <span class="icon-right" onclick="togglePassword('loginPassword', this)">👁</span>
      </div>

      <div class="auth-forgot">
        <a href="/?url=forgot_password">Lupa password?</a>
      </div>

      <button type="submit" class="auth-btn">Login</button>
    </form>

    <p class="auth-link">Belum punya akun? <a href="/?url=register">Daftar</a></p>
  </div>
</div>

<script>
function togglePassword(id, icon) {
  const input = document.getElementById(id);
  input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
