<h2 class="admin-page-title">Dashboard</h2>

<div class="admin-stat-grid">
  <div class="admin-stat-card">
    <div class="stat-value"><?= $total_users ?? 0 ?></div>
    <div class="stat-label">Total User</div>
  </div>
  <div class="admin-stat-card">
    <div class="stat-value"><?= $total_games ?? 0 ?></div>
    <div class="stat-label">Total Game</div>
  </div>
  <div class="admin-stat-card">
    <div class="stat-value"><?= $total_items ?? 0 ?></div>
    <div class="stat-label">Item Top-Up</div>
  </div>
  <div class="admin-stat-card">
    <div class="stat-value"><?= $total_transaksi ?? 0 ?></div>
    <div class="stat-label">Transaksi</div>
  </div>
</div>

<div class="admin-table-wrapper">
  <div class="admin-table-header">
    <h3>Game Terdaftar</h3>
    <a href="/?url=admin_games" class="admin-btn admin-btn-edit">Kelola Game</a>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Game</th>
        <th>Gambar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($games ?? [] as $g): ?>
        <tr>
          <td><?= htmlspecialchars($g['id_game']) ?></td>
          <td><?= htmlspecialchars($g['nama_game']) ?></td>
          <td>
            <img src="/assets/logo_game/<?= htmlspecialchars($g['gambar_game']) ?>"
                 alt="<?= htmlspecialchars($g['nama_game']) ?>"
                 style="height:32px; object-fit:contain;">
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
