<?php 

require_once "../koneksi/conn.php";

class Product extends Conn
{
    public function getProduct($sql)
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