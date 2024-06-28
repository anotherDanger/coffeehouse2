<?php 

require_once "../koneksi/conn.php";

class History extends Conn
{

    public function getHistory($username)
    {
        $conn = $this->conn;
        $sql = "SELECT t.transaction_id, t.username, t.product_name, t.quantity,
        td.name, td.phone, td.address, td.order_date, td.total, t.status, p.product_image FROM transactions t INNER JOIN
        transaction_detail td USING(transaction_id) INNER JOIN products p using(product_id) WHERE td.username = ?";
        $query = $conn->prepare($sql);
        $query->execute([$username]);
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }

        return $rows;
    }

    public function historyPrint($id)
    {
        $conn = $this->conn;
        $sql = "SELECT t.transaction_id, t.username, t.product_name, t.quantity,
        td.name, td.phone, td.address, td.order_date, td.total, t.status, p.product_image FROM transactions t INNER JOIN
        transaction_detail td USING(transaction_id) INNER JOIN products p using(product_id) WHERE t.transaction_id = ?";
        $query = $conn->prepare($sql);
        $query->execute([$id]);
        $rows = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            $rows[] = $row;
        }

        return $rows;
    }
}

?>