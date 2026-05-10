<?php
session_start();
require_once '../config/database.php';
require_once '../helpers/functions.php';

$action = $_POST['action'] ?? '';

if ($action === 'login') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $conn = getConnection();
    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user   = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        redirect('/games');
    } else {
        redirect('/login?error=invalid');
    }
}

if ($action === 'register') {
    $username         = trim($_POST['username'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        redirect('/register?error=password_mismatch');
    }

    $conn   = getConnection();
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt   = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $email, $hashed);

    if ($stmt->execute()) {
        redirect('/login?success=registered');
    } else {
        redirect('/register?error=failed');
    }
}

if ($action === 'forgot_password') {
    $email = trim($_POST['email'] ?? '');
    // TODO: implementasi kirim email reset password
    redirect('/login?info=reset_sent');
}

if ($action === 'logout') {
    session_destroy();
    redirect('/login');
}
