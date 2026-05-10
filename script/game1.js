const canvas = document.getElementById('game1Canvas');
const ctx    = canvas.getContext('2d');
let score    = 0;
let running  = false;

document.getElementById('startBtn').addEventListener('click', () => {
    running = true;
    gameLoop();
});

document.getElementById('resetBtn').addEventListener('click', () => {
    running = false;
    score   = 0;
    document.getElementById('score').textContent = score;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
});

function gameLoop() {
    if (!running) return;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#1a1a2e';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#e94560';
    ctx.font = '24px Segoe UI';
    ctx.fillText('Game 1 berjalan... Skor: ' + score, 50, 80);
    score++;
    document.getElementById('score').textContent = score;
    setTimeout(() => requestAnimationFrame(gameLoop), 100);
}
