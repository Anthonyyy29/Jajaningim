<?php
include "koneksi.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if ($password !== $confirmPassword) {
    echo "<script>
        alert('Konfirmasi password tidak sama!');
        window.location.href='register.html';
    </script>";
    exit;
}

if (strlen($password) < 6) {
    echo "<script>
        alert('Password minimal 6 karakter!');
        window.location.href='register.html';
    </script>";
    exit;
}

$cekEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($cekEmail) > 0) {
    echo "<script>
        alert('Email sudah terdaftar!');
        window.location.href='register.html';
    </script>";
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, email, password) 
          VALUES ('$username', '$email', '$passwordHash')";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Registrasi berhasil!');
        window.location.href='../PageLogin/index.html';
    </script>";
} else {
    echo "<script>
        alert('Registrasi gagal: " . mysqli_error($conn) . "');
        window.location.href='register.html';
    </script>";
}
?>