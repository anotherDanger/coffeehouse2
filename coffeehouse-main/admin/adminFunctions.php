<?php 

require_once "../koneksi/conn.php";

class Admin extends Conn
{
    public $quantity;

    public function getAdmin()
    {
        $conn = $this->conn;
        $query = $conn->prepare("SELECT COUNT(*) FROM admin");
        $query->execute();

        $result = $query->fetchColumn();

        return $result;


    }

    public function getUser($sql)
    {
        $conn = $this->conn;
        $query = $conn->prepare($sql);
        $query->execute();
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }
        return $rows;
    }

    public function insertTransc($data)
    {
        $conn = $this->conn;
        $user_id = $data['user_id'];
        $status = $data['status'];

        $query = $conn->prepare("UPDATE transaction SET status = ? WHERE user_id = ?;");
        $query->execute([$status, $user_id]);

        return $query->rowCount();
    }

    public function adminUpdate($id)
    {
        $conn = $this->conn;
        $nama = $id;
        $query = $conn->prepare("UPDATE products SET product_name = 'Kopi Jawir' WHERE product_id = ?");
        $query->execute([$id]);

        return $query->rowCount();
    }

    public function getQuantity($sql)
    {
        $conn = $this->conn;
        $rows = [];
        $query = $conn->prepare($sql);
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }

        return $rows;
    }
}


?>