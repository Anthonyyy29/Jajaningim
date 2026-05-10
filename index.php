<?php
session_start();

$url = trim($_GET['url'] ?? 'home', '/');

$is_admin = str_starts_with($url, 'admin');

require_once $is_admin ? 'view/layout/header_admin.php' : 'view/layout/header.php';


/* ============================================================
   Helper: cek sesi admin, redirect ke login jika belum masuk
   ============================================================ */
function require_admin(): void {
    if (empty($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
        header('Location: /?url=login');
        exit;
    }
}


switch ($url) {

    /* ----------------------------------------------------------
       HALAMAN PUBLIK
    ---------------------------------------------------------- */
    case 'home':
        require_once 'app/config/connection.php';
        $stmt  = $pdo->query("SELECT id_game, nama_game, gambar_game FROM games ORDER BY id_game ASC");
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/pages/home.php';
        break;

    case 'login':           require_once 'view/pages/login.php';          break;
    case 'register':        require_once 'view/pages/register.php';       break;
    case 'forgot_password': require_once 'view/pages/forgot_password.php'; break;
    case 'about':           require_once 'view/pages/about.php';          break;
    case 'transaction':     require_once 'view/pages/transaction.php';    break;

    case 'games':
        require_once 'app/config/connection.php';
        $stmt  = $pdo->query("SELECT id_game, nama_game, gambar_game FROM games ORDER BY nama_game ASC");
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/pages/games.php';
        break;

    case 'game1':
        require_once 'app/config/connection.php';
        $stmt = $pdo->prepare("SELECT id_item, label_item, price FROM game_items WHERE id_games = 1 ORDER BY price ASC");
        $stmt->execute();
        $game_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/pages/games_page/game1.php';
        break;

    /* ----------------------------------------------------------
       PANEL ADMIN
    ---------------------------------------------------------- */
    case 'admin':
        require_admin();
        require_once 'app/config/connection.php';
        $total_users     = (int)$pdo->query("SELECT COUNT(*) FROM akun")->fetchColumn();
        $total_games     = (int)$pdo->query("SELECT COUNT(*) FROM games")->fetchColumn();
        $total_items     = (int)$pdo->query("SELECT COUNT(*) FROM game_items")->fetchColumn();
        $total_transaksi = (int)$pdo->query("SELECT COUNT(*) FROM transaksi")->fetchColumn();
        $stmt  = $pdo->query("SELECT id_game, nama_game, gambar_game FROM games ORDER BY id_game ASC");
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/admin/dashboard.php';
        break;

    case 'admin_games':
        require_admin();
        require_once 'app/config/connection.php';
        $stmt  = $pdo->query("SELECT id_game, nama_game, gambar_game FROM games ORDER BY id_game ASC");
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/admin/kelola_game.php';
        break;

    case 'admin_users':
        require_admin();
        require_once 'app/config/connection.php';
        $stmt  = $pdo->query("SELECT id_akun, username_akun, email, role FROM akun ORDER BY id_akun ASC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/admin/kelola_user.php';
        break;

    case 'admin_transaksi':
        require_admin();
        require_once 'app/config/connection.php';
        $stmt      = $pdo->query("SELECT * FROM transaksi ORDER BY id_transaksi DESC");
        $transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'view/admin/kelola_transaksi.php';
        break;

    default:
        require_once 'view/pages/home.php';
}


require_once $is_admin ? 'view/layout/footer_admin.php' : 'view/layout/footer.php';
