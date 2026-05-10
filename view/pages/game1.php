<?php include '../layout/header.php'; ?>

<main class="game-page">
    <h2>Game 1</h2>
    <div class="game-area">
        <canvas id="game1Canvas" width="800" height="500"></canvas>
    </div>
    <div class="game-controls">
        <button id="startBtn" class="btn">Mulai</button>
        <button id="resetBtn" class="btn btn-outline">Reset</button>
    </div>
    <p>Skor: <span id="score">0</span></p>
</main>

<script src="/script/game1.js"></script>
<?php include '../layout/footer.php'; ?>
