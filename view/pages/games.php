<?php
$grouped = [];
foreach (($games ?? []) as $game) {
    $firstChar = strtoupper(mb_substr($game['nama_game'], 0, 1));
    $key = ctype_alpha($firstChar) ? $firstChar : '#';
    $grouped[$key][] = $game;
}
ksort($grouped);
if (isset($grouped['#'])) {
    $hash = $grouped['#'];
    unset($grouped['#']);
    $grouped['#'] = $hash;
}
$availableLetters = array_keys($grouped);
?>

<div class="games-page">

  <div class="games-index">
    <?php
    $letters = array_merge(range('A', 'Z'), ['#']);
    foreach ($letters as $letter):
    ?>
      <a href="#section-<?= $letter ?>"
         class="index-letter <?= in_array($letter, $availableLetters) ? '' : 'index-letter-disabled' ?>"
         <?= in_array($letter, $availableLetters) ? '' : 'tabindex="-1"' ?>>
        <?= $letter ?>
      </a>
    <?php endforeach; ?>
  </div>

  <div class="games-list">
    <?php foreach ($grouped as $letter => $items): ?>
      <div class="games-group" id="section-<?= $letter ?>">
        <div class="games-group-header"><?= $letter ?></div>
        <div class="games-grid">
          <?php foreach ($items as $game): ?>
          <a href="/?url=game<?= $game['id_game'] ?>" class="game-card">
            <img src="/assets/logo_game/<?= htmlspecialchars($game['gambar_game']) ?>"
                 alt="<?= htmlspecialchars($game['nama_game']) ?>">
            <p><?= htmlspecialchars($game['nama_game']) ?></p>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<script>
document.querySelectorAll('.index-letter:not(.index-letter-disabled)').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(link.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});
</script>
