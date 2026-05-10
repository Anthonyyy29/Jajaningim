<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JajaninGim</title>
  <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
  <div class="page">
    <header class="navbar">
      <div class="logo-box">
        <img src="/assets/logo_jajaningim/logo.png" alt="JajaninGim Logo">
      </div>

      <h1 class="site-title">JajaninGim.site</h1>

      <div class="nav-right">
        <div class="search-box">
          <input type="text" id="searchInput" placeholder="Find Games...">
          <button id="searchBtn">⌕</button>
        </div>
        <nav class="nav-links">
          <a href="/?url=home">Home</a>
          <a href="/?url=games">Games</a>
          <a href="/?url=about">About</a>
        </nav>
        <?php if (!empty($_SESSION['user'])): ?>
          <?php $username = htmlspecialchars($_SESSION['user']['username_akun'] ?? 'Akun'); ?>
          <div class="nav-user">
            <button class="nav-user-btn" id="userMenuBtn" aria-expanded="false">
              <span class="nav-user-avatar">
                <img src="/assets/logo_jajaningim/users.png" alt="akun">
              </span>
              <span class="nav-user-name"><?= $username ?></span>
              <span class="nav-user-caret">▾</span>
            </button>
            <div class="nav-user-dropdown tersembunyi" id="userMenuDropdown">
              <div class="nav-user-dropdown-info">
                <span><?= $username ?></span>
                <small><?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></small>
              </div>
              <div class="nav-user-dropdown-divider"></div>
              <form method="POST" action="/app/handlers/request.php">
                <input type="hidden" name="action" value="logout">
                <button type="submit" class="nav-user-dropdown-logout">Logout</button>
              </form>
            </div>
          </div>
        <?php else: ?>
          <a href="/?url=login" class="login-btn">Login/Register</a>
        <?php endif; ?>
      </div>
    </header>

    <script>
      (function () {
        const btn      = document.getElementById('userMenuBtn');
        const dropdown = document.getElementById('userMenuDropdown');
        if (!btn) return;

        btn.addEventListener('click', function (e) {
          e.stopPropagation();
          const open = !dropdown.classList.contains('tersembunyi');
          dropdown.classList.toggle('tersembunyi', open);
          btn.setAttribute('aria-expanded', String(!open));
        });

        document.addEventListener('click', function () {
          dropdown.classList.add('tersembunyi');
          btn.setAttribute('aria-expanded', 'false');
        });
      })();
    </script>