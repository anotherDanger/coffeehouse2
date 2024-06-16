<?php 

require_once "../koneksi/conn.php";

class Profil extends Conn
{
    function getProfil($sql) : array
    {
        $conn = $this->conn;
        $sql = $conn->prepare("$sql");
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