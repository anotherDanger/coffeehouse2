<?php 
session_start();
require_once "../koneksi/conn.php";

class Checkout extends Conn
{

    public function getUser()
    {
        
        $conn = $this->conn;
        $sql = 'SELECT * FROM users WHERE username = ?';
        $query = $conn->prepare($sql);
        $query->execute([$_SESSION['login']]);
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getProduct($id)
    {
        
        $conn = $this->conn;
        $sql = 'SELECT * FROM products WHERE product_id = ?';
        $query = $conn->prepare($sql);
        $query->execute([$id]);
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }
        return $rows;
    }

    public function checkout($data)
    {
        $conn = $this->conn;
        $quantity = $data['quantity'];
        $username = $_SESSION['login'];

        // Ambil informasi produk berdasarkan ID
        $product_id = $data['product_id'];
        $products = $this->getProduct($product_id);
        $product_name = $products[0]['product_name'];


        $users = $this->getUser();
        $user_id = $users[0]['user_id'];


        $price = $products[0]['product_price'];
        $total = $quantity * $price;

        $conn->beginTransaction();
        try {
            // Generate transaction_id
            $prefix = 'TRX';
            $transaction_id = $prefix . '_' . time(); 
            

            
            $query = $conn->prepare("INSERT INTO transactions (transaction_id, user_id, username, product_id, product_name, quantity, price, total, created_at, status)
                                    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW(), 'pending')");
            $query->execute([$user_id, $username, $product_id, $product_name, $quantity, $price, $total]);



            
            $query_detail = $conn->prepare("INSERT INTO transactions_detail (transaction_id, product_id, product_name, quantity, price, subtotal)
                                           VALUES (?, ?, ?, ?, ?, ?)");
            $subtotal = $quantity * $price;
            $query_detail->execute([$transaction_id, $product_id, $product_name, $quantity, $price, $subtotal]);


            $conn->commit();


            return $query->rowCount();
        } catch (PDOException $e) {

            $conn->rollback();
            throw $e;
        }
    }
}



?>