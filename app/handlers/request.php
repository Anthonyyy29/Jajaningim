<?php
/**
 * request.php — Handler untuk semua POST request dari form.
 *
 * Alur:
 *   Form HTML kirim POST ke /app/handlers/request.php
 *   dengan field tersembunyi: <input type="hidden" name="action" value="login|register">
 *   Handler memproses input, query DB, lalu redirect kembali ke router (index.php).
 *
 * Tidak ada output HTML di sini — hanya logic + redirect.
 */

session_start();
require_once __DIR__ . '/../config/connection.php';

$action = $_POST['action'] ?? '';


/* ============================================================
   ACTION: LOGIN
   Dipanggil dari form di view/pages/login.php
   ============================================================ */
if ($action === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    /**
     * Cari user berdasarkan username.
     * Menggunakan prepared statement (?) agar aman dari SQL injection.
     * Hasilnya satu baris atau false jika tidak ditemukan.
     */
    $stmt = $pdo->prepare("SELECT * FROM akun WHERE username_akun = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    /**
     * password_verify() membandingkan password plain-text dari form
     * dengan hash bcrypt yang tersimpan di DB.
     * Jika cocok, simpan seluruh data user ke session.
     */
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $redirect = ($user['role'] ?? '') === 'admin' ? '/?url=admin' : '/?url=home';
        header("Location: $redirect");
    } else {
        // Username tidak ditemukan atau password salah — kirim kode error ke view
        header('Location: /?url=login&error=invalid');
    }
    exit;
}


/* ============================================================
   ACTION: REGISTER
   Dipanggil dari form di view/pages/register.php
   ============================================================ */
if ($action === 'register') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // Validasi panjang password sebelum menyentuh DB
    if (strlen($password) < 6) {
        header('Location: /?url=register&error=password_short');
        exit;
    }

    // Validasi konfirmasi password cocok
    if ($password !== $confirm) {
        header('Location: /?url=register&error=password_mismatch');
        exit;
    }

    /**
     * Cek apakah email sudah terdaftar di tabel akun.
     * Hanya ambil id_user (lebih efisien daripada SELECT *).
     * Jika fetch() mengembalikan data, berarti email sudah ada.
     */
    $stmt = $pdo->prepare("SELECT id_akun FROM akun WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header('Location: /?url=register&error=email_exists');
        exit;
    }

    /**
     * Hash password menggunakan bcrypt (PASSWORD_DEFAULT).
     * Plain-text password TIDAK pernah disimpan ke DB.
     * Kemudian insert data user baru ke tabel akun.
     */
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO akun (username_akun, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hash]);

    // Registrasi berhasil — arahkan ke login dengan notifikasi sukses
    header('Location: /?url=login&success=registered');
    exit;
}


/* ============================================================
   ACTION: LOGOUT
   ============================================================ */
if ($action === 'logout') {
    session_destroy();
    header('Location: /?url=login');
    exit;
}
