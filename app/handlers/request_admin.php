<?php
/**
 * request_admin.php — Handler POST khusus admin.
 *
 * Semua form di panel admin mengirim POST ke file ini
 * dengan field tersembunyi: <input type="hidden" name="action" value="...">
 *
 * PRASYARAT DB:
 *   ALTER TABLE akun MODIFY COLUMN password VARCHAR(255) NOT NULL;
 *   ALTER TABLE akun ADD COLUMN role ENUM('user','admin') DEFAULT 'user';
 *   UPDATE akun SET role = 'admin' WHERE username_akun = 'namaadmin';
 */

session_start();
require_once __DIR__ . '/../config/connection.php';

$action = $_POST['action'] ?? '';


/* ============================================================
   Cek sesi admin (kecuali logout)
   ============================================================ */
if ($action !== 'admin_logout') {
    if (empty($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
        header('Location: /?url=login');
        exit;
    }
}


/* ============================================================
   ACTION: ADMIN_LOGOUT
   ============================================================ */
if ($action === 'admin_logout') {
    session_destroy();
    header('Location: /?url=login');
    exit;
}


/* ============================================================
   Helper: proses upload file gambar, return nama file atau false
   ============================================================ */
function upload_logo(array $file): string|false {
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $max_size      = 2 * 1024 * 1024; // 2MB

    if ($file['error'] !== UPLOAD_ERR_OK)   return false;
    if ($file['size'] > $max_size)          return false;
    if (!in_array($file['type'], $allowed_types)) return false;

    $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = uniqid('game_') . '.' . $ext;
    $dest     = __DIR__ . '/../../assets/logo_game/' . $filename;

    return move_uploaded_file($file['tmp_name'], $dest) ? $filename : false;
}


/* ============================================================
   ACTION: ADD_GAME
   ============================================================ */
if ($action === 'add_game') {
    $nama = trim($_POST['nama_game'] ?? '');

    if ($nama === '' || empty($_FILES['gambar_game']['name'])) {
        header('Location: /?url=admin_games&error=empty');
        exit;
    }

    $gambar = upload_logo($_FILES['gambar_game']);
    if ($gambar === false) {
        header('Location: /?url=admin_games&error=upload_fail');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO games (nama_game, gambar_game) VALUES (?, ?)");
    $stmt->execute([$nama, $gambar]);

    header('Location: /?url=admin_games&status=added');
    exit;
}


/* ============================================================
   ACTION: EDIT_GAME
   ============================================================ */
if ($action === 'edit_game') {
    $id_game     = (int)($_POST['id_game']    ?? 0);
    $nama        = trim($_POST['nama_game']   ?? '');
    $gambar_lama = trim($_POST['gambar_lama'] ?? '');

    if ($id_game === 0 || $nama === '') {
        header('Location: /?url=admin_games&error=empty');
        exit;
    }

    // Pakai file baru jika diupload, jika tidak tetap pakai yang lama
    if (!empty($_FILES['gambar_game']['name'])) {
        $gambar = upload_logo($_FILES['gambar_game']);
        if ($gambar === false) {
            header('Location: /?url=admin_games&error=upload_fail');
            exit;
        }
    } else {
        $gambar = $gambar_lama;
    }

    $stmt = $pdo->prepare("UPDATE games SET nama_game = ?, gambar_game = ? WHERE id_game = ?");
    $stmt->execute([$nama, $gambar, $id_game]);

    header('Location: /?url=admin_games&status=updated');
    exit;
}


/* ============================================================
   ACTION: DELETE_GAME
   ============================================================ */
if ($action === 'delete_game') {
    $id_game = (int)($_POST['id_game'] ?? 0);

    if ($id_game > 0) {
        $stmt = $pdo->prepare("DELETE FROM games WHERE id_game = ?");
        $stmt->execute([$id_game]);
    }

    header('Location: /?url=admin_games&status=deleted');
    exit;
}


/* ============================================================
   ACTION: DELETE_USER
   ============================================================ */
if ($action === 'delete_user') {
    $id_user      = (int)($_POST['id_user']          ?? 0);
    $current_user = (int)($_SESSION['user']['id_akun'] ?? 0);

    if ($id_user === $current_user) {
        header('Location: /?url=admin_users&error=self_delete');
        exit;
    }

    if ($id_user > 0) {
        $stmt = $pdo->prepare("DELETE FROM akun WHERE id_akun = ? AND role != 'admin'");
        $stmt->execute([$id_user]);
    }

    header('Location: /?url=admin_users&status=deleted');
    exit;
}
