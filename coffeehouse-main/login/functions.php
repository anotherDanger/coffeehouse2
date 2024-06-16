<?php 

require_once "../koneksi/conn.php";
require_once "../loginTrait/loginTrait.php";

// Class Login untuk users
class LoginUser extends Conn implements LoginInterface {
    use TableAccessTrait;

    public function getLogin($data) {
        $username = $data["username"];
        $password = $data["password"];

        $conn = $this->conn;
        $table = $this->table;
        $sql = $conn->prepare("SELECT * FROM $table WHERE username = ?");
        $sql->execute([$username]);

        if ($sql) {
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                if (password_verify($password, $row["password"])) {
                    $_SESSION['login'] = $_POST['username'];
                    return true;
                } else {
                    return false;
                }
            } else {
                $this->conn = null;
                echo "Username tidak ditemukan!";
                exit;
            }
        }
    }
}



?>