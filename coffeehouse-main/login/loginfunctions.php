<?php 
session_start();
require_once "functions.php";

$login = new Login();

if(isset($_POST['login']))
{
    if($login->getLogin($_POST))
    {
        $login->conn = null;
        header("Location: ../main/index.php");
        exit;
    }else
    {
        $login->conn = null;
        $_SESSION['error'] = 'Username/Password salah!';
        header("Location: login.php");
        exit;
    }
}


?>