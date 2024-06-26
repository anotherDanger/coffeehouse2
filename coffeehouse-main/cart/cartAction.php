<?php
require_once "../products/product.php";
require_once "cartFunction.php";

$products = new Product();

if (isset($_SESSION['login']) && isset($_GET['product_id']) && isset($_GET['quantity'])) {
    $username = $_SESSION['login'];
    $product_id = $_GET['product_id'];
    $product = $products->getProduct("SELECT product_name FROM products WHERE product_id = '$product_id'");
    $product_name = $product[0]['product_name']; // Ambil product_name dari hasil query

    $quantity = $_GET['quantity'];

    $carts = new Cart();
    $sql = "INSERT INTO cart VALUES(NULL, '$username', '$product_id', '$product_name', '$quantity')";

    $cart = $carts->insertCart($sql);

    if ($cart > 0) {
        echo "Berhasil";
        header("Location: ../main/index.php");
        exit;
    } else {
        echo "Gagal";
    }
}

?>