<?php 
session_start();
require_once "../koneksi/conn.php";
require_once "../products/product.php";


class Cart extends Conn {

    public function insertCart($sql) {
        $conn = $this->conn;
        $query = $conn->prepare($sql);
        $query->execute();

        return $query->rowCount();
    }

    function getCart($sql) : array
    {
        $conn = $this->conn;
        $sql = $conn->prepare($sql);
        $sql->execute([$_SESSION['login']]);
        $rows = [];
        while($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }

        return $rows;
    }
}


?>