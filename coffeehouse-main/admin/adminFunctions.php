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

    public function getTotalUser()
    {
        $conn = $this->conn;
        $query = $conn->prepare("SELECT COUNT(*) FROM users");
        $query->execute();

        $result = $query->fetchColumn();

        return $result;
    }

    public function getTotalProducts()
    {
        $conn = $this->conn;
        $query = $conn->prepare("SELECT COUNT(*) FROM products");
        $query->execute();

        $result = $query->fetchColumn();

        return $result;
    }

    public function getTotalOrders()
    {
        $conn = $this->conn;
        $query = $conn->prepare("SELECT COUNT(*) FROM transactions");
        $query->execute();

        $result = $query->fetchColumn();

        return $result;
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

    public function updtProduct($sql)
    {
        $conn = $this->conn;
        $query = $conn->prepare($sql);
        $query->execute();

        return $query->rowCount();
    }
    
}


?>