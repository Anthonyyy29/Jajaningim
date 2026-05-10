<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo "<script>
            alert('Konfirmasi password tidak sama!');
            window.location.href='register.php';
        </script>";
        exit;
    }

    if (strlen($password) < 6) {
        echo "<script>
            alert('Password minimal 6 karakter!');
            window.location.href='register.php';
        </script>";
        exit;
    }

    $cekEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($cekEmail) > 0) {
        echo "<script>
            alert('Email sudah terdaftar!');
            window.location.href='register.php';
        </script>";
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) 
              VALUES ('$username', '$email', '$passwordHash')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Registrasi berhasil!');
            window.location.href='../PageLogin/login.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Registrasi gagal: " . mysqli_error($conn) . "');
            window.location.href='register.php';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="container">

    <!-- KIRI -->
    <div class="left">

        <!-- DEKORASI KIRI -->
        <span class="deco circle circle1"></span>
        <span class="deco circle circle2"></span>
        <span class="deco circle circle3"></span>

        <span class="deco spark spark1">✦</span>
        <span class="deco spark spark2">✦</span>
        <span class="deco spark spark3">✦</span>

        <span class="deco lightning lightning1">⚡</span>
        <span class="deco lightning lightning2">⚡</span>

        <div class="left-content">

            <img src="asset_registrasi/logo.png" class="logo">

            <h1>
                Belanja game<br>
                favoritmu sekarang!
            </h1>

            <p>Top up cepat dan harga bersahabat.</p>

            <div class="promo-box">
                <img src="asset_registrasi/hadiah.png" class="gift">
                <p>
                    Dapatkan promo pembelian<br>
                    pertama sebesar <b>10%</b><br>
                    hanya dengan register
                </p>
            </div>

        </div>
    </div>

    <!-- KANAN -->
    <div class="right">

        <h2>Daftar Akun Baru</h2>
        <p class="subtitle">
            Buat akun untuk mulai top up dan belanja game di Jajanin Gim
        </p>

        <form action="register.php" method="POST" onsubmit="return validasiPassword()" autocomplete="off">

            <label>Username</label>
            <div class="input-box">
                <img src="asset_registrasi/user.png" class="icon-left">
                <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
            </div>

            <label>Email</label>
            <div class="input-box">
                <img src="asset_registrasi/email.png" class="icon-left">
                <input type="email" name="email" placeholder="Masukkan email" required autocomplete="off">
            </div>

            <label>Password</label>
            <div class="input-box">
                <img src="asset_registrasi/lock.png" class="icon-left">
                <input type="password" name="password" id="password" placeholder="Masukkan password" required autocomplete="new-password">
                <span class="icon-right" onclick="lihatPassword('password', this)">👁</span>
            </div>

            <label>Konfirmasi Password</label>
            <div class="input-box">
                <img src="asset_registrasi/lock.png" class="icon-left">
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Ulangi password" required autocomplete="new-password">
                <span class="icon-right" onclick="lihatPassword('confirmPassword', this)">👁</span>
            </div>

            <button type="submit">Daftar Sekarang</button>

        </form>

        <p class="link-login">
            Sudah punya akun? <a href="../PageLogin/login.php">Login</a>
        </p>

    </div>

</div>

<!-- JAVASCRIPT -->
<script>
function validasiPassword() {
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirmPassword").value;

    if (password.length < 6) {
        alert("Password minimal 6 karakter!");
        return false;
    }

    if (password !== confirm) {
        alert("Konfirmasi password tidak sama!");
        return false;
    }

    return true;
}

function lihatPassword(idInput, icon) {
    let input = document.getElementById(idInput);

    if (input.type === "password") {
        input.type = "text";
        icon.textContent = "👁";
    } else {
        input.type = "password";
        icon.textContent = "👁";
    }
}
</script>

</body>
</html>