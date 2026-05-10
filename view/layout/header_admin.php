<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin — JajaninGim</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
  <div class="admin-wrapper">
    <aside class="admin-sidebar">
      <div class="admin-brand">
        <img src="/assets/logo_jajaningim/logo.png" alt="Logo">
        <span>Admin Panel</span>
      </div>

      <nav class="admin-nav">
        <a href="/?url=admin"
           class="admin-nav-link <?= ($url ?? '') === 'admin' ? 'terpilih' : '' ?>">
          Dashboard
        </a>
        <a href="/?url=admin_games"
           class="admin-nav-link <?= ($url ?? '') === 'admin_games' ? 'terpilih' : '' ?>">
          Kelola Game
        </a>
        <a href="/?url=admin_users"
           class="admin-nav-link <?= ($url ?? '') === 'admin_users' ? 'terpilih' : '' ?>">
          Kelola User
        </a>
        <a href="/?url=admin_transaksi"
           class="admin-nav-link <?= ($url ?? '') === 'admin_transaksi' ? 'terpilih' : '' ?>">
          Kelola Transaksi
        </a>
      </nav>

      <form class="admin-logout-form" method="POST" action="/app/handlers/request_admin.php">
        <input type="hidden" name="action" value="admin_logout">
        <button type="submit" class="admin-logout-btn">Logout</button>
      </form>
    </aside>

    <main class="admin-main">
