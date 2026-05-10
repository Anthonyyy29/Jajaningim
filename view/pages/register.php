<?php
$error = $_GET['error'] ?? '';
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
        <img src="/add_rivan/registerpage/asset_registrasi/hadiah.png" class="gift">
        <p>Dapatkan promo pembelian<br>pertama sebesar <b>10%</b><br>hanya dengan register</p>
      </div>
    </div>
  </div>

  <div class="auth-right">
    <h2>Daftar Akun Baru</h2>
    <p class="auth-subtitle">Buat akun untuk mulai top up dan belanja game di Jajanin Gim</p>

    <?php if ($error === 'email_exists'): ?>
      <div class="auth-alert">Email sudah terdaftar!</div>
    <?php elseif ($error === 'password_mismatch'): ?>
      <div class="auth-alert">Konfirmasi password tidak sama!</div>
    <?php elseif ($error === 'password_short'): ?>
      <div class="auth-alert">Password minimal 6 karakter!</div>
    <?php endif; ?>

    <form action="/app/handlers/request.php" method="POST" autocomplete="off">
      <input type="hidden" name="action" value="register">

      <label>Username</label>
      <div class="input-box">
        <img src="/add_rivan/registerpage/asset_registrasi/user.png" class="icon-left">
        <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
      </div>

      <label>Email</label>
      <div class="input-box">
        <img src="/add_rivan/registerpage/asset_registrasi/email.png" class="icon-left">
        <input type="email" name="email" placeholder="Masukkan email" required autocomplete="off">
      </div>

      <label>Password</label>
      <div class="input-box">
        <img src="/add_rivan/registerpage/asset_registrasi/lock.png" class="icon-left">
        <input type="password" name="password" id="regPassword" placeholder="Masukkan password" required autocomplete="new-password">
        <span class="icon-right" onclick="togglePassword('regPassword', this)">👁</span>
      </div>

      <label>Konfirmasi Password</label>
      <div class="input-box">
        <img src="/add_rivan/registerpage/asset_registrasi/lock.png" class="icon-left">
        <input type="password" name="confirm_password" id="regConfirm" placeholder="Ulangi password" required autocomplete="new-password">
        <span class="icon-right" onclick="togglePassword('regConfirm', this)">👁</span>
      </div>

      <button type="submit" class="auth-btn">Daftar Sekarang</button>
    </form>

    <p class="auth-link">Sudah punya akun? <a href="/?url=login">Login</a></p>
  </div>
</div>

<script>
function togglePassword(id, icon) {
  const input = document.getElementById(id);
  input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
