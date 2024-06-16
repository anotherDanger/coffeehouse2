<?php 

require_once "adminFunctions.php";
$product_id = $_GET['product_id'];

$update = new Admin();
$updt = $update->adminUpdate($product_id);

if($updt > 0)
{
    echo "Berhasil";
}






?>