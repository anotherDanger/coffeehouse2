<?php 
session_start();
require_once "admin_login_functions.php";
require_once "../loginTrait/loginTrait.php";

$login = new LoginAdmin();
$login->setTable('admin');


if(isset($_POST['login']))
{
    if($login->getLogin($_POST))
    {
        $login->conn = null;
        header("Location: admin_home.php");
        exit;
    }else
    {
        $login->conn = null;
        $_SESSION['error'] = 'Username/Password salah!';
        header("Location: admin_login.php");
        exit;
    }
}


?>