<?php
session_start();
require_once "../koneksi/conn.php";
require_once "../products/product.php";
require_once "../profil/function.php";
require_once "cartFunction.php";

// Mendapatkan data dari GET atau POST
$username = isset($_GET['username']) ? $_GET['username'] : '';
$productName = isset($_GET['product_name']) ? $_GET['product_name'] : '';
$productId = isset($_GET['product_id']) ? $_GET['product_id'] : '';
$quantity = $_GET['quantity'];

// Memastikan data yang diterima dari GET atau POST aman untuk digunakan
$username = htmlspecialchars($username);
$productName = htmlspecialchars($productName);
$productId = htmlspecialchars($productId);

// Memastikan hanya user yang login yang bisa menambahkan produk ke keranjang
if (!isset($_SESSION['login'])) {
    header("Location: ../login/login.php");
    exit;
}

// Membuat instance dari kelas Cart
$carts = new Cart();

// Memanggil metode addToCart untuk menambahkan produk ke keranjang
$addedToCart = $carts->addToCart($productId, $username, $quantity);

if ($addedToCart) {
    header("Location: index3.php");
    exit;
} else {
    echo "Gagal menambahkan produk ke keranjang.";
}
?>