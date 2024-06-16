<?php 

require_once "../koneksi/conn.php";

class Login extends Conn
{
    public function getLogin($data)
    {
        $username = $data["username"];
        $password = $data["password"];

        $conn = $this->conn;

        $sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $sql->execute([$username]);
        

        if($sql)
        {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if($row)
            {
                if(password_verify($password, $row["password"]))
                {
                    $_SESSION['login'] = $_POST['username'];
                    return true;
                }else
                {
                    return false;
                }
            }else
            {
                $this->conn = null;
                echo "Username tidak ditemukan!";
                exit;
            }
        }
        

    }
}



?>
