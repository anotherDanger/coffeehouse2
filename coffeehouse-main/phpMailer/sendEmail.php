<?php
session_start();
require_once '../../vendor/autoload.php';

require_once "../checkout/historyFunction.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$id = $_POST['id'];
$username = $_SESSION['login'];


$history = new History();
$data = $history->historyPrint($id)[0];


$mpdf = new \Mpdf\Mpdf();


$html = '
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Faktur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h2 {
            color: #007bff;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Laporan Faktur</h2>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Nama Produk</th>
                    <th>Quantity</th>
                    <th>Alamat</th>
                    <th>Tanggal Pesanan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>' . htmlspecialchars($data['transaction_id']) . '</td>
                    <td>' . htmlspecialchars($data['name']) . '</td>
                    <td>' . htmlspecialchars($data['phone']) . '</td>
                    <td>' . htmlspecialchars($data['product_name']) . '</td>
                    <td>' . htmlspecialchars($data['quantity']) . '</td>
                    <td>' . htmlspecialchars($data['address']) . '</td>
                    <td>' . htmlspecialchars($data['order_date']) . '</td>
                    <td>' . htmlspecialchars($data['total']) . '</td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-total">
            <strong>Total Pembayaran: ' . htmlspecialchars($data['total']) . '</strong>
        </div>
    </div>
</body>
</html>';


$mpdf->WriteHTML($html);


$pdfContent = $mpdf->Output('', 'S');


$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'andhikadanger1@gmail.com';
    $mail->Password   = 'bpdaaazryyzsxuhg';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Penerima
    $mail->setFrom('andhikadanger1@gmail.com', 'Patri Coffeehouse');
    $mail->addAddress($_POST['email'], 'User');

    // Lampiran PDF
    $mail->addStringAttachment($pdfContent, 'laporan_faktur.pdf', 'base64', 'application/pdf');


    $mail->isHTML(true);
    $mail->Subject = 'Patri Coffeehouse';
    $mail->Body    = 'Berikut faktur transaksi anda.';
    $mail->AltBody = 'Berikut faktur transaksi anda.';


    $mail->send();
    $_SESSION['message'] = 'Email berhasil dikirim';
    header("Location: ../checkout/history.php");
    exit;
} catch (Exception $e) {

    $_SESSION['message'] = "Email tidak dapat dikirim/tidak ditemukan";


    header('Location: ../checkout/history.php');
    exit();
}
?>