<?php 

require_once "../products/product.php";
$id = $_GET['product_id'];

$product = new Product();
if($product->deleteProduct($id))
{
    header("Location: admin_product.php");
    exit;
}



?>