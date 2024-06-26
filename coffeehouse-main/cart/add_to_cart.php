<?php
require_once('action.php');

$action = new Action();
$result = $action->addToCart($_POST['product_id'], $_POST['quantity']);

if ($result) {
  echo json_encode(['status' => 'success', 'message' => 'Berhasil ditambahkan']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Gagal ditambahkan!']);
}
