<h2 class="admin-page-title">Kelola Transaksi</h2>

<div class="admin-table-wrapper">
  <div class="admin-table-header">
    <h3>Riwayat Transaksi (<?= count($transaksi ?? []) ?>)</h3>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Akun / Guest</th>
        <th>Payment</th>
        <th>Game User ID</th>
        <th>Status Transaksi</th>
        <th>Status Bayar</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($transaksi)): ?>
        <tr>
          <td colspan="8" style="text-align:center; color:#9aa0a8; padding:24px;">
            Belum ada transaksi.
          </td>
        </tr>
      <?php else: ?>
        <?php foreach ($transaksi as $t): ?>
          <tr>
            <td><?= (int)$t['id_transaksi'] ?></td>
            <td><?= (int)$t['id_item'] ?></td>
            <td>
              <?php if (!empty($t['id_akun'])): ?>
                <span style="color:#ddd;">Akun #<?= (int)$t['id_akun'] ?></span>
              <?php elseif (!empty($t['guest_session_id'])): ?>
                <span style="color:#9aa0a8;">Guest #<?= (int)$t['guest_session_id'] ?></span>
              <?php else: ?>
                <span style="color:#555;">—</span>
              <?php endif; ?>
            </td>
            <td><?= (int)$t['id_payment'] ?></td>
            <td style="font-size:12px;">
              <?= htmlspecialchars($t['game_user_id'] ?? '—') ?>
              <?php if (!empty($t['game_zone_id'])): ?>
                <span style="color:#9aa0a8;">(<?= htmlspecialchars($t['game_zone_id']) ?>)</span>
              <?php endif; ?>
            </td>
            <td>
              <?php
                $st = $t['status_transaksi'] ?? 'pending';
                $st_color = match($st) {
                  'success' => '#81c784',
                  'failed'  => '#e57373',
                  default   => '#ffb74d',
                };
              ?>
              <span style="color:<?= $st_color ?>; font-size:12px; font-weight:600;">
                <?= $st ?>
              </span>
            </td>
            <td>
              <?php $sp = $t['status_payment'] ?? 'unpaid'; ?>
              <span style="color:<?= $sp === 'paid' ? '#81c784' : '#e57373' ?>; font-size:12px; font-weight:600;">
                <?= $sp ?>
              </span>
            </td>
            <td style="font-size:12px; color:#9aa0a8;">
              <?= htmlspecialchars($t['date_transaksi'] ?? '—') ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
