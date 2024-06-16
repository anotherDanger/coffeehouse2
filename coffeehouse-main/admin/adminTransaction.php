<?php 

require_once "adminFunctions.php";

$transc = new Admin();
$update = $transc->insertTransc($_POST);

if(isset($_POST['update']))
{
    if($update > 0)
    {
        echo "Berhasil";
    }
}


?>