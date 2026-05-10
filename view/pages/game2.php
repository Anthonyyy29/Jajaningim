<?php include '../layout/header.php'; ?>

<main class="game-page">
    <h2>Game 2</h2>
    <div class="game-area">
        <canvas id="game2Canvas" width="800" height="500"></canvas>
    </div>
    <div class="game-controls">
        <button id="startBtn" class="btn">Mulai</button>
        <button id="resetBtn" class="btn btn-outline">Reset</button>
    </div>
    <p>Skor: <span id="score">0</span></p>
</main>

<script src="/script/game2.js"></script>
<?php include '../layout/footer.php'; ?>
