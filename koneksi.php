<?php
// Membuat koneksi ke database
$conn = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "ecommerce");

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>