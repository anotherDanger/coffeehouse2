<?php
session_start();
require_once "functions.php";

$login = new LoginUser();
$login->setTable('users');

// Memeriksa apakah form login telah disubmit
if (isset($_POST['login'])) {
    // Melakukan proses login menggunakan metode getLogin dari kelas LoginUser
    if ($login->getLogin($_POST)) {
        // Jika login berhasil
        $login->conn = null; // Menutup koneksi database
        if (isset($_POST['remember'])) {
            // Jika opsi "Remember Me" dicentang, hash nilai yang relevan
            $hashed_username = hash('sha256', $_POST['username']);
            // Set cookie dengan nama 'remember_me' atau yang sesuai
            setcookie('remember_me', $hashed_username, time() + (86400 * 30), '/'); // Cookie berumur 30 hari
        }
        header("Location: ../main/index.php"); // Redirect ke halaman utama setelah login berhasil
        exit;
    } else {
        // Jika login gagal
        $login->conn = null; // Menutup koneksi database
        $_SESSION['error'] = 'Username/Password salah!'; // Menyimpan pesan error dalam session
        header("Location: login.php"); // Redirect kembali ke halaman login dengan pesan error
        exit;
    }
}
?>