<?php
require_once('action.php');

$action = new Action();
$result = $action->clearCart();

if ($result) {
  echo json_encode(['status' => 'success', 'message' => 'Keranjang berhasil dihapus']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus keranjang']);
}
