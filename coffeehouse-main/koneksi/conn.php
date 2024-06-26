<?php 

abstract class Conn
{
    private $host = "localhost";
    private $port = 3306;
    private $dbName = "coffeehouse";
    private $username = "root";
    private $password = "andhikad";

    public $conn;

    //konstruktor
    public function __construct()
    {
        try
        {
            $this->conn = new PDO("mysql:host=$this->host:$this->port;dbname=$this->dbName", $this->username, $this->password);
        }catch(Exception $e)
        {
            echo "Koneksi Ke Database Gagal " . $e->getMessage();
        }
    }

    // public function getConn()
    // {
    //     try
    //     {
    //         $this->conn = new PDO("mysql:host=$this->host:$this->port;dbname=$this->dbName", $this->username, $this->password);
    //         return $this->conn;
    //     }catch(Exception $e)
    //     {
    //         echo "Koneksi Ke Database Gagal " . $e->getMessage();
    //     }
    // }
    public function __destruct()
    {
        // Tutup koneksi saat objek dihancurkan
        $this->conn = null;
    }
}


?>