<?php
$edit_game = null;
if (!empty($_GET['edit_id'])) {
    foreach ($games ?? [] as $g) {
        if ((int)$g['id_game'] === (int)$_GET['edit_id']) {
            $edit_game = $g;
            break;
        }
    }
}
?>

<h2 class="admin-page-title">Kelola Game</h2>

<?php if (($_GET['status'] ?? '') === 'added'): ?>
  <div class="admin-alert admin-alert-success">Game berhasil ditambahkan.</div>
<?php elseif (($_GET['status'] ?? '') === 'updated'): ?>
  <div class="admin-alert admin-alert-success">Game berhasil diperbarui.</div>
<?php elseif (($_GET['status'] ?? '') === 'deleted'): ?>
  <div class="admin-alert admin-alert-success">Game berhasil dihapus.</div>
<?php elseif (($_GET['error'] ?? '') === 'upload_fail'): ?>
  <div class="admin-alert admin-alert-error">Upload gagal. Pastikan file berupa gambar (JPG, PNG, WEBP) dan ukuran maks 2MB.</div>
<?php elseif (($_GET['error'] ?? '') === 'empty'): ?>
  <div class="admin-alert admin-alert-error">Nama game dan logo wajib diisi.</div>
<?php endif; ?>

<!-- Form tambah / edit -->
<div class="admin-form-card">
  <?php if ($edit_game): ?>
    <h3>Edit Game: <?= htmlspecialchars($edit_game['nama_game']) ?></h3>
    <form method="POST" action="/app/handlers/request_admin.php" enctype="multipart/form-data">
      <input type="hidden" name="action"          value="edit_game">
      <input type="hidden" name="id_game"         value="<?= (int)$edit_game['id_game'] ?>">
      <input type="hidden" name="gambar_lama"     value="<?= htmlspecialchars($edit_game['gambar_game']) ?>">
      <div class="admin-form-row">
        <div class="admin-form-group">
          <label>Nama Game</label>
          <input type="text" name="nama_game"
                 value="<?= htmlspecialchars($edit_game['nama_game']) ?>" required>
        </div>
        <div class="admin-form-group">
          <label>Ganti Logo (kosongkan jika tidak ingin mengganti)</label>
          <input type="file" name="gambar_game" accept="image/*">
          <div style="margin-top:8px; display:flex; align-items:center; gap:10px;">
            <img src="/assets/logo_game/<?= htmlspecialchars($edit_game['gambar_game']) ?>"
                 alt="logo saat ini" style="height:36px; object-fit:contain;">
            <span style="font-size:12px; color:#9aa0a8;"><?= htmlspecialchars($edit_game['gambar_game']) ?></span>
          </div>
        </div>
      </div>
      <div class="admin-form-actions">
        <button type="submit" class="admin-btn admin-btn-add">Simpan Perubahan</button>
        <a href="/?url=admin_games" class="admin-btn admin-btn-cancel">Batal</a>
      </div>
    </form>

  <?php else: ?>
    <h3>Tambah Game Baru</h3>
    <form method="POST" action="/app/handlers/request_admin.php" enctype="multipart/form-data">
      <input type="hidden" name="action" value="add_game">
      <div class="admin-form-row">
        <div class="admin-form-group">
          <label>Nama Game</label>
          <input type="text" name="nama_game" placeholder="Contoh: Mobile Legends" required>
        </div>
        <div class="admin-form-group">
          <label>Logo Game</label>
          <input type="file" name="gambar_game" accept="image/*" required>
        </div>
      </div>
      <div class="admin-form-actions">
        <button type="submit" class="admin-btn admin-btn-add">Tambah Game</button>
      </div>
    </form>
  <?php endif; ?>
</div>

<!-- Tabel daftar game -->
<div class="admin-table-wrapper">
  <div class="admin-table-header">
    <h3>Daftar Game (<?= count($games ?? []) ?>)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Game</th>
        <th>Logo</th>
        <th>File</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($games ?? [] as $g): ?>
        <tr>
          <td><?= (int)$g['id_game'] ?></td>
          <td><?= htmlspecialchars($g['nama_game']) ?></td>
          <td>
            <img src="/assets/logo_game/<?= htmlspecialchars($g['gambar_game']) ?>"
                 alt="<?= htmlspecialchars($g['nama_game']) ?>"
                 style="height:30px; object-fit:contain;">
          </td>
          <td style="color:#9aa0a8; font-size:12px;"><?= htmlspecialchars($g['gambar_game']) ?></td>
          <td>
            <a href="/?url=admin_games&edit_id=<?= (int)$g['id_game'] ?>"
               class="admin-btn admin-btn-edit">Edit</a>

            <form method="POST" action="/app/handlers/request_admin.php"
                  style="display:inline;"
                  onsubmit="return confirm('Hapus game <?= htmlspecialchars($g['nama_game'], ENT_QUOTES) ?>?')">
              <input type="hidden" name="action"  value="delete_game">
              <input type="hidden" name="id_game" value="<?= (int)$g['id_game'] ?>">
              <button type="submit" class="admin-btn admin-btn-delete">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
