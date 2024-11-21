<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['message'] = "Username tidak ditemukan.";
    $_SESSION['message_type'] = "error";
    header("Location: Shopi.php");
    exit();
}

$user = $result->fetch_assoc();

if ($password != $user['password']) {
    $_SESSION['message'] = "Password yang Anda masukkan salah.";
    $_SESSION['message_type'] = "error";
    header("Location: Shopi.php");
    exit();
}

$_SESSION['username'] = $username;
$_SESSION['logged_in'] = true;
$_SESSION['message'] = "Selamat datang kembali, " . $username . "!";
$_SESSION['message_type'] = "success";

// Periksa apakah user adalah admin
if ($user['akses'] == 'admin') {
    header("Location: admin.php");
} else {
    header("Location: puki.php");
}

$stmt->close();
$conn->close();
exit();
?>