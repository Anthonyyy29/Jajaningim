<?php
/**
 * setup_admin.php — Jalankan SEKALI di browser untuk buat akun admin.
 * Setelah selesai, HAPUS file ini dari server.
 *
 * Akses via: http://localhost/nama-folder/setup_admin.php
 */

require_once 'app/config/connection.php';

$username = 'admin';
$email    = 'admin@jajaningim.com';
$password = 'admin123';

// Cek apakah sudah ada
$stmt = $pdo->prepare("SELECT id_akun FROM akun WHERE username_akun = ?");
$stmt->execute([$username]);

if ($stmt->fetch()) {
    // Kalau sudah ada, pastikan role-nya admin
    $stmt = $pdo->prepare("UPDATE akun SET role = 'admin' WHERE username_akun = ?");
    $stmt->execute([$username]);
    echo "<p style='font-family:sans-serif; color:orange;'>Akun '$username' sudah ada — role diset ke <b>admin</b>.</p>";
} else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO akun (username_akun, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->execute([$username, $email, $hash]);
    echo "<p style='font-family:sans-serif; color:green;'>Akun admin berhasil dibuat!</p>";
}
?>
<style>body{font-family:sans-serif;padding:30px;background:#1a1e24;color:#eee;}</style>
<h3>Info Login Admin</h3>
<table border="1" cellpadding="8" style="border-collapse:collapse;">
  <tr><td>Username</td><td><b><?= $username ?></b></td></tr>
  <tr><td>Password</td><td><b><?= $password ?></b></td></tr>
  <tr><td>URL Login</td><td><a href="/?url=login" style="color:#00b8c8;">/?url=login</a></td></tr>
</table>
<br>
<p style="color:#e57373;">⚠ Hapus file <b>setup_admin.php</b> setelah selesai!</p>
