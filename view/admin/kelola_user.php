<h2 class="admin-page-title">Kelola User</h2>

<?php if (($_GET['status'] ?? '') === 'deleted'): ?>
  <div class="admin-alert admin-alert-success">User berhasil dihapus.</div>
<?php elseif (($_GET['error'] ?? '') === 'self_delete'): ?>
  <div class="admin-alert admin-alert-error">Tidak bisa menghapus akun admin yang sedang aktif.</div>
<?php endif; ?>

<div class="admin-table-wrapper">
  <div class="admin-table-header">
    <h3>Daftar User (<?= count($users ?? []) ?>)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users ?? [] as $u): ?>
        <?php $role = $u['role'] ?? 'user'; ?>
        <tr>
          <td><?= (int)$u['id_akun'] ?></td>
          <td><?= htmlspecialchars($u['username_akun']) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td>
            <?php if ($role === 'admin'): ?>
              <span class="badge-admin">admin</span>
            <?php else: ?>
              <span class="badge-user">user</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($role !== 'admin'): ?>
              <form method="POST" action="/app/handlers/request_admin.php"
                    style="display:inline;"
                    onsubmit="return confirm('Hapus user <?= htmlspecialchars($u['username_akun'], ENT_QUOTES) ?>?')">
                <input type="hidden" name="action"  value="delete_user">
                <input type="hidden" name="id_user" value="<?= (int)$u['id_akun'] ?>">
                <button type="submit" class="admin-btn admin-btn-delete">Hapus</button>
              </form>
            <?php else: ?>
              <span style="color:#555;font-size:12px;">—</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
