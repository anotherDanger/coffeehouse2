<?php

session_start();


unset($_SESSION['login']);


session_destroy();

if (isset($_COOKIE['user'])) {
    setcookie('user', '', time() - 3600, '/');
}

if (isset($_COOKIE['id'])) {
    setcookie('id', '', time() - 3600, '/');
}

header("Location: index.php");
exit;
?>