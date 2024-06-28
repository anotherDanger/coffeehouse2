<?php

require_once('action.php');

$action = new Action();
$cartItems = $action->getCart();

$totalAmount = 0;

if (!empty($cartItems)) {
  echo '<ul class="list-group">';
  foreach ($cartItems as $item) {
    $subtotal = $item['product_price'] * $item['quantity'];
    $totalAmount += $subtotal;

    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
    echo '<div>';
    echo '<h6>' . htmlspecialchars($item['product_name']) . '</h6>';
    echo '<p>Quantity: ' . htmlspecialchars($item['quantity']) . '</p>';
    echo '<p>Harga/pcs: Rp.' . htmlspecialchars($item['product_price']) . '</p>';
    echo '<p>Sub-Total: Rp.' . htmlspecialchars($subtotal) . '</p>';
    echo '</div>';
    echo '<div>';
    echo '<img src="../img-coffee/' . htmlspecialchars($item['product_image']) . '" alt="' . htmlspecialchars($item['product_name']) . '" style="width: 50px; height: 50px;">';
    echo '<button class="btn btn-danger btn-sm ms-2 delete-item-btn" data-product-id="' . htmlspecialchars($item['product_id']) . '">Hapus</button>';
    echo '<button class="btn btn-success btn-sm ms-2 checkout-item-btn" data-product-id="' . htmlspecialchars($item['product_id']) . '">Checkout</button>';
    echo '</div>';
    echo '</li>';
  }
  echo '</ul>';
  echo '<div class="total-amount mt-3">';
  echo '<h5>Total: Rp.' . htmlspecialchars($totalAmount) . '</h5>';
  echo '</div>';
  echo '<div class="cart-actions mt-3">';
  echo '<button class="btn btn-danger" id="clearCartBtn">Kosongkan Keranjang</button> ';
  // Tombol "Checkout" di sini tidak diperlukan, karena akan muncul di setiap produk.
  echo '</div>';
} else {
  echo '<p>Keranjang kamu kosong!</p>';
}
