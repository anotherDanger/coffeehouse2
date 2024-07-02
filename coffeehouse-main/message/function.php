<?php 
session_start();
require_once "../koneksi/conn.php";
require_once "../profil/function.php";

class Messages extends Conn{


    function getProfil($sql, $params = []) : array
    {
        $conn = $this->conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $rows;
    }

    public function sendMessage($data)
    {
    $conn = $this->conn;
    $nama = $data['nama'];
    $message = $data['message'];
    $username = $_SESSION['login'];

    // Mengambil informasi profil pengguna
    $profil = new Profil();
    $getUser = $profil->getProfil("SELECT * FROM users WHERE username = '$username'");
    // Pastikan mengambil satu baris dengan FETCH_ASSOC atau FETCH_OBJ
    if (!empty($getUser)) {
        $user_id = $getUser[0]['user_id']; // Ambil kolom user_id dari hasil query

        // Persiapan dan eksekusi query untuk menyimpan pesan
        $sql = "INSERT INTO messages VALUES (NULL, ?, ?, ?, NOW())";
        $query = $conn->prepare($sql);
        $query->execute([$user_id, $nama, $message]);

        return $query->rowCount(); // Mengembalikan jumlah baris yang terpengaruh oleh operasi INSERT
    } else {
        // Handle jika data pengguna tidak ditemukan
        return false;
    }
}
public function getMessage($sql)
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
public function messageDelete($id)
{
    $conn = $this->conn;
    $query = $conn->prepare("DELETE FROM messages WHERE message_id = ?");
    $query->execute([$id]);
    return $query->rowCount();
}

}


?>