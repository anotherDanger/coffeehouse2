<?php 

require_once "../koneksi/conn.php";

class Signup extends Conn
{
    public function signUp($data)
    {
        $username = $data["username"];
        $password = $data["password"];
        $password2 = $data["password2"];
    
        // Validasi input
        if (empty($username) || empty($password) || empty($password2)) {
            return -1; // Input tidak lengkap
        }
    
        parent::__construct();

        $conn = $this->conn;
        $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);

        if ($query->rowCount() > 0) {
            return -2; // Username sudah ada
        }
        if($password !== $password2)
        {
            return -3;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO users VALUES(NULL,?, ?,NULL, NOW())");
        $insert->execute([$username, $hashedPassword]);
        
        // Tutup koneksi
        $this->conn = null;
        
        return $insert->rowCount();
    }

}

?>