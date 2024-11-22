<?php
session_start();
include 'koneksi.php';

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$akses = $_POST['akses'];

// Cek username yang sudah ada
$stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['message'] = "Username sudah digunakan. Silakan gunakan username lain.";
    $_SESSION['message_type'] = "error";
    header("Location: Shopi.php");
    exit();
}

// Cek email yang sudah ada
$stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['message'] = "Email sudah digunakan. Silakan gunakan email lain.";
    $_SESSION['message_type'] = "error";
    header("Location: Shopi.php");
    exit();
}

// Insert data baru
$stmt = $conn->prepare("INSERT INTO login (username, password, email, akses) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $password, $email, $akses);

if ($stmt->execute()) {
    $_SESSION['message'] = "Registrasi berhasil! Silakan login.";
    $_SESSION['message_type'] = "success";
} else {
    $_SESSION['message'] = "Gagal melakukan registrasi. Silakan coba lagi.";
    $_SESSION['message_type'] = "error";
}

$stmt->close();
$conn->close();
header("Location: Shopi.php");
exit();
?>