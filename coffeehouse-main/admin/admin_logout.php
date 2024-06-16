<?php
// Mulai sesi
session_start();

// Hapus variabel sesi yang ingin dihapus
unset($_SESSION['admin']);

// Hapus seluruh sesi jika perlu
session_destroy();

// Redirect ke halaman login atau halaman lain yang sesuai
header("Location: admin_login.php");
exit; // Pastikan untuk keluar setelah melakukan pengalihan header
?>