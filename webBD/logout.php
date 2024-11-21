<?php
session_start();
session_destroy();
session_start();
$_SESSION['message'] = "Logout berhasil!";
$_SESSION['message_type'] = "success";
header(header: "Location:Puki.php");
exit();
?>
