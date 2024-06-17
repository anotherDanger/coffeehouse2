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

    public function addProduct($data)
    {
        $conn = $this->conn;
        $product_id = $data["product_id"];
        $product_name = $data["product_name"];
        $product_price = $data["product_price"];
        $product_stock = $data["product_stock"];
        $product_desc = $data["product_desc"];

        $image = $this->productUpload();

        $sql = "INSERT INTO products VALUES(?, ?, ?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->execute([$product_id, $product_name, $product_price, $product_stock, $product_desc, $image]);

        return $query->rowCount();

    }

    public function productUpload()
    {
        $name = $_FILES['image']['name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
        $tmpNmae = $_FILES['image']['tmp_name'];

        //validasi
        if($error === 4)
        {
            echo "<script>
                alert('Tidak ada file yang dipilih');
            </script>";
            return false;
        }
        $ekstensiValid = ['jpg','jpeg','png'];
        $ekstensiFile = explode('.', $name);
        $ekstensiFile = strtolower(end($ekstensiFile));
        
        if(!in_array($ekstensiFile, $ekstensiValid))
        {
            echo "<script>
                alert('Ekstensi tidak didukung');
            </script>";
            return false;
        }

        if($size > 1000000)
        {
            echo "<script>
                alert('Ukuran terlalu besar');
            </script>";
            return false;
        }

        $namaBaru = uniqid();
        $namaBaru .= '.';
        $namaBaru .= $ekstensiFile;

        move_uploaded_file($tmpNmae, 'img/' . $namaBaru);
        
        return $namaBaru;
    }

}



?>