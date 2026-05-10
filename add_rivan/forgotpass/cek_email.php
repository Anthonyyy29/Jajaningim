<?php
include "koneksi.php";

$email = $_POST['email'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($query) > 0) {
    echo "terdaftar";
} else {
    echo "tidak";
}
?>