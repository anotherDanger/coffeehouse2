<?php 
session_start();
require_once "function.php";
$upload = new Upload();
if(isset($_POST['upload']))
{
    $unggah = $upload->upload();
    if($unggah)
    {
        $update = $upload->update($unggah);
        if($update > 0)
        {
            header("Location: ../main/index.php");
            exit;
        }
    }
}

if($_FILES['foto']['error'] === 4)
{
    header("Location: ../main/index.php");
    exit;
}

?>