<?php
session_start();
require_once "functions.php";

if (isset($_POST['submit'])) {
    $conn = new Signup();
    $signup = $conn->signUp($_POST);

    

    if ($signup > 0) {
        header("Location: ../main/index.php");
        $_SESSION['login'] = $_POST["username"];
        exit;
    } else {
        if ($signup == -1) {
            echo "<script>
                alert('Semua field harus diisi');
                document.location.href = 'create_account.php';
            </script>";
        } elseif ($signup == -2) {
            echo "<script>
                alert('Username sudah ada!');
                document.location.href = 'create_account.php';
            </script>";
        } elseif ($signup == -3) {
            $error = true;
            echo "<script>
                alert('Password salah!');
                document.location.href = 'create_account.php';
            </script>";
        } else {
            $error_message = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}
?>