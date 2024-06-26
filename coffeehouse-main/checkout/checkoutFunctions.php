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
        $nama = $data['nama'];
        $noHP = $data['no_hp'];
        $alamat = $data['alamat'];
        // Ambil informasi produk berdasarkan ID
        $product_id = $data['product_id'];
        $products = $this->getProduct($product_id)[0];
        $product_name = $products['product_name'];


        $users = $this->getUser()[0];
        $user_id = $users['user_id'];


        $price = $products['product_price'];
        $total = $quantity * $price;

        $conn->beginTransaction();
        try {
            // Generate transaction_id
            $prefix = 'TRX';
            $transaction_id = $prefix . '_' . time(); 
            

            
            $query = $conn->prepare("INSERT INTO transactions (transaction_id, username, product_id, product_name, quantity, price, total, created_at, status)
                                    VALUES (NULL, ?, ?, ?, ?, ?, ?, NOW(), 'pending')");
            $query->execute([$username, $product_id, $product_name, $quantity, $price, $total]);



            
            $query_detail = $conn->prepare("INSERT INTO transaction_detail (transaction_id, user_id, username, name, phone, product_name, address, order_date, total)
                                           VALUES (?, ?, ?, ?, ?, ?, ?,NOW(), ?)");
            $subtotal = $quantity * $price;
            $query_detail->execute([$transaction_id, $user_id, $username, $nama, $noHP, $product_name, $alamat, $subtotal]);


            $conn->commit();


            return $query->rowCount();
        } catch (PDOException $e) {

            $conn->rollback();
            throw $e;
        }
    }
}



?>