<?php
include "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if (strlen($password) < 8) {
    echo "<script>
        alert('Password minimal 8 karakter!');
        window.location.href='index.html';
    </script>";
    exit;
}

if ($password !== $confirmPassword) {
    echo "<script>
        alert('Konfirmasi password tidak sama!');
        window.location.href='index.html';
    </script>";
    exit;
}

$cekEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($cekEmail) == 0) {
    echo "<script>
        alert('Email tidak terdaftar!');
        window.location.href='index.html';
    </script>";
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$query = "UPDATE users SET password='$passwordHash' WHERE email='$email'";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Password berhasil direset! Silakan login.');
        window.location.href='../PageLogin/index.html';
    </script>";
} else {
    echo "<script>
        alert('Password gagal direset!');
        window.location.href='index.html';
    </script>";
}
?>