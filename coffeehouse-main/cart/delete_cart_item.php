<?php
require_once('action.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
  $action = new Action();
  $product_id = $_POST['product_id'];

  $result = $action->deleteCartItem($product_id);

  if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Item berhasil dihapus']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus item']);
  }
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
