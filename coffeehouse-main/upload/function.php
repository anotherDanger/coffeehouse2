<?php 

require_once "../koneksi/conn.php";


class Upload extends Conn
{

    public $gambar;


    public function upload()
    {
        $namaFile = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        if($error === 4)
        {
            echo "<script>
                alert('Tidak ada file yang dipilih');
            </script>";
            return false;
        }
        $ekstensiValid = ['jpg','jpeg','png'];
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        
        if(!in_array($ekstensiFile, $ekstensiValid))
        {
            echo "<script>
                alert('Ekstensi tidak didukung');
            </script>";
            return false;
        }

        if($ukuranFile > 1000000)
        {
            echo "<script>
                alert('Ukuran terlalu besar');
            </script>";
            return false;
        }

        $namaBaru = uniqid();
        $namaBaru .= '.';
        $namaBaru .= $ekstensiFile;

        move_uploaded_file($tmpName, '../main/img/' . $namaBaru);

        $this->gambar = $namaBaru;
        
        return $namaBaru;
    
    }

    public function update($data)
    {
        $conn = $this->conn;
        $gambar = $data;
        $username = $_SESSION['login'];
        $sql = $conn->prepare("UPDATE users SET user_image = ? WHERE username = ?");
        $sql->execute([$gambar, $username]);

        return $sql->rowCount();

    }
}


?>