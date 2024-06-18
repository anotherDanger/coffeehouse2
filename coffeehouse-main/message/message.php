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

?>