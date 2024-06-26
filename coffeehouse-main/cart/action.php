<?php
session_start();
require_once "../koneksi/conn.php";

class Action extends Conn
{

  public function getUser()
  {

    $conn = $this->conn;
    $sql = 'SELECT * FROM users WHERE username = ?';
    $query = $conn->prepare($sql);
    $query->execute([$_SESSION['login']]);
    $rows = [];
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }

  public function addToCart($product_id, $quantity)
  {
    $conn = $this->conn;
    $user_id = $this->getUser()[0]['user_id'];

    $sql = 'SELECT * FROM cart WHERE user_id = ? AND product_id = ?';
    $query = $conn->prepare($sql);
    $query->execute([$user_id, $product_id]);
    $cartItem = $query->fetch(PDO::FETCH_ASSOC);

    if ($cartItem) {
      $newQuantity = $cartItem['quantity'] + $quantity;
      $updateSql = 'UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?';
      $updateQuery = $conn->prepare($updateSql);
      return $updateQuery->execute([$newQuantity, $user_id, $product_id]);
    } else {
      $insertSql = 'INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)';
      $insertQuery = $conn->prepare($insertSql);
      return $insertQuery->execute([$user_id, $product_id, $quantity]);
    }
  }


  public function getCart()
  {
    $conn = $this->conn;
    $user = $this->getUser();
    $sql = 'SELECT 
        cart.quantity,
        products.product_id,
        products.product_name,
        products.product_price,
        products.product_image
    FROM cart
    INNER JOIN products ON cart.product_id = products.product_id
    WHERE cart.user_id = ?';
    
    $query = $conn->prepare($sql);
    $query->execute([$user[0]['user_id']]);
    $rows = [];
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }

  public function clearCart()
  {
    $user_id = $this->getUser()[0]['user_id'];
    $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function deleteCartItem($product_id)
  {
    $user_id = $this->getUser()[0]['user_id'];
    $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    return $stmt->execute();
  }
}
