<?php 
require_once "../koneksi/conn.php";



class Profil extends Conn
{

    public function getId($sql)
    {
        $conn = $this->conn;
        $sql = $conn->prepare($sql);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    function getProfil($sql)
    {
        $conn = $this->conn;
        $sql = $conn->prepare($sql);
        $sql->execute();
        $rows = [];
        while($row = $sql->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }

        return $rows;
    }
}


?>