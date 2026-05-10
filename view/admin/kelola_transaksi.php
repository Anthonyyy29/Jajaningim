<h2 class="admin-page-title">Kelola Transaksi</h2>

<div class="admin-table-wrapper">
  <div class="admin-table-header">
    <h3>Riwayat Transaksi (<?= count($transaksi ?? []) ?>)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Item ID</th>
        <th>Payment ID</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($transaksi)): ?>
        <tr>
          <td colspan="7" style="text-align:center; color:#9aa0a8; padding:24px;">
            Belum ada transaksi.
          </td>
        </tr>
      <?php else: ?>
        <?php foreach ($transaksi as $t): ?>
          <tr>
            <td><?= (int)$t['id_transaksi'] ?></td>
            <td><?= isset($t['id_user'])    ? (int)$t['id_user']    : '—' ?></td>
            <td><?= isset($t['id_item'])    ? (int)$t['id_item']    : '—' ?></td>
            <td><?= isset($t['id_payment']) ? (int)$t['id_payment'] : '—' ?></td>
            <td>
              <?= isset($t['total'])
                  ? 'Rp ' . number_format($t['total'], 0, ',', '.')
                  : '—' ?>
            </td>
            <td><?= isset($t['status']) ? htmlspecialchars($t['status']) : '—' ?></td>
            <td style="font-size:12px; color:#9aa0a8;">
              <?= isset($t['created_at']) ? htmlspecialchars($t['created_at']) : '—' ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
