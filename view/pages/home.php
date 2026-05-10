<main class="content">
  <div class="hero-text">
    <h2>SELAMAT DATANG DI<br>JAJANINGIM.SITE</h2>
    <p>Platform top-up game terpercaya, cepat, dan mudah!</p>
    <h4>Lebih dari 1 juta gamer sudah bergabung</h4>
  </div>

  <section class="games-section">
    <h3>GAME POPULER</h3>
    <div class="game-grid">
      <?php foreach (($games ?? []) as $game): ?>
      <a href="/?url=game<?= $game['id_game'] ?>" class="game-card">
        <img src="/assets/logo_game/<?= htmlspecialchars($game['gambar_game']) ?>" alt="<?= htmlspecialchars($game['nama_game']) ?>">
        <p><?= htmlspecialchars($game['nama_game']) ?></p>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <a href="/?url=games" class="discover">DISCOVER MORE GAMES &rarr;</a>
</main>
