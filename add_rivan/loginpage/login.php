<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        if (password_verify($password, $data['password'])) {
            echo "<script>
                alert('Login berhasil!');
                window.location.href='login.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Password salah!');
                window.location.href='login.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('Username tidak terdaftar!');
            window.location.href='login.php';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
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

            <img src="asset_login/logo.png" class="logo">

            <h1>
                Belanja game<br>
                favoritmu sekarang!
            </h1>

            <p>Top up cepat dan harga bersahabat.</p>

            <div class="promo-box">
                <img src="asset_login/hadiah.png" class="gift">
                <p>
                    Nikmati kemudahan top up<br>
                    game favoritmu hanya di<br>
                    <b>Jajanin Gim</b>
                </p>
            </div>

        </div>
    </div>

    <!-- KANAN -->
    <div class="right">

        <h2>Masuk Akun</h2>
        <p class="subtitle">
            Login untuk mulai top up dan belanja game di Jajanin Gim
        </p>

        <form action="login.php" method="POST" autocomplete="off">

            <label>Username</label>
            <div class="input-box">
                <img src="asset_login/user.png" class="icon-left">
                <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
            </div>

            <label>Password</label>
            <div class="input-box">
                <img src="asset_login/lock.png" class="icon-left">
                <input type="password" name="password" id="loginPassword" placeholder="Masukkan password" required autocomplete="new-password">
                <span class="icon-right" onclick="lihatPassword('loginPassword', this)">👁</span>
            </div>

            <div class="forgot-password">
                <a href="../PageLupaPass/index.php">Lupa password?</a>
            </div>

            <button type="submit">Login</button>

        </form>

        <p class="link-login">
            Belum punya akun? <a href="../Registrasi/register.php">Daftar</a>
        </p>

    </div>

</div>

<!-- JAVASCRIPT -->
<script>
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