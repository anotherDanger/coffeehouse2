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
    $username = $_SESSION['login']; // Menggunakan username dari session

    // Ambil informasi produk berdasarkan ID
    $product_id = $data['product_id'];
    $products = $this->getProduct($product_id);
    $product_name = $products[0]['product_name']; // Ambil nama produk dari hasil query

    // Ambil informasi pengguna berdasarkan username dari session
    $users = $this->getUser();
    $user_id = $users[0]['user_id']; // Ambil user_id dari hasil query

    // Hitung total (gunakan price dari produk)
    $price = $products[0]['product_price'];
    $total = $quantity * $price;

    // Persiapkan dan eksekusi query INSERT
    $query = $conn->prepare("INSERT INTO transactions (transaction_id, user_id, username, product_id, product_name, quantity, price, total, created_at, status)
                            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW(), 'pending')");
    $query->execute([$user_id, $username, $product_id, $product_name, $quantity, $price, $total]);

    // Mengembalikan jumlah baris yang terpengaruh (biasanya 1 jika berhasil)
    return $query->rowCount();
}
}


?>