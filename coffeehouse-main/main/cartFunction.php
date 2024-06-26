<?php

require_once "../koneksi/conn.php";

class Cart extends Conn {
    public function addToCart($productId, $username, $quantity)
    {
        // Check if product already exists in cart
        $existingItem = $this->getCartItem($productId, $username);

        if ($existingItem) {
            // If product already exists, update the quantity
            $newQuantity = $existingItem['quantity'] + $quantity;
            $sql = "UPDATE cart SET quantity = ? WHERE product_id = ? AND username = ?";
            $conn = $this->conn;
            $query = $conn->prepare($sql);
            $query->execute([$newQuantity, $productId, $username]);
        } else {
            // If product doesn't exist, insert new item into cart
            $sql = "INSERT INTO cart (product_id, username, quantity) VALUES (?, ?, ?)";
            $conn = $this->conn;
            $query = $conn->prepare($sql);
            $query->execute([$productId, $username, $quantity]);
        }

        return true; // Return true if successful
    }

    public function showCart($username)
    {
        $sql = "SELECT * FROM cart WHERE username = ?";
        $conn = $this->conn;
        $query = $conn->prepare($sql);
        $query->execute([$username]);
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getCartItem($productId, $username)
    {
        $sql = "SELECT * FROM cart WHERE product_id = ? AND username = ?";
        $conn = $this->conn;
        $query = $conn->prepare($sql);
        $query->execute([$productId, $username]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row; // Return null if not found
    }
}

?>