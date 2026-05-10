<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    if (password_verify($password, $data['password'])) {
        echo "<script>
            alert('Login berhasil!');
            window.location.href='index.html';
        </script>";
    } else {
        echo "<script>
            alert('Password salah!');
            window.location.href='index.html';
        </script>";
    }
} else {
    echo "<script>
        alert('Username tidak terdaftar!');
        window.location.href='index.html';
    </script>";
}
?>