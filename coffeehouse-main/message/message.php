<?php 

require_once "function.php";

if(isset($_POST['kirim']))
{
    $message = new Messages();
    $messages = $message->sendMessage($_POST);
    if($messages > 0)
    {
        echo "Berhasil";
        exit;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'GET')
{
    $id = $_GET['id'];
    $message = new Messages();
    $deleteMessage = $message->messageDelete($id);
    if($deleteMessage > 0)
    {
        header("Location: ../admin/admin_messages.php");
    }
}

?>