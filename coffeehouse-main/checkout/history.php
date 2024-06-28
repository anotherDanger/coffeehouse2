<?php 
session_start();

require_once "historyFunction.php";
$username = $_SESSION['login'];
$getHistory = new History();
$history = $getHistory->getHistory($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .history-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 5px;
        }
        .transaction-list {
            list-style-type: none;
            padding: 0;
        }
        .transaction-item {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f5f5f5;
            position: relative; /* Menambahkan posisi relatif untuk penempatan gambar */
        }
        .transaction-item h5 {
            margin-bottom: 10px;
        }
        .transaction-list li {
            margin-bottom: 8px;
        }
        .transaction-image {
            max-width: 100px; /* Atur lebar gambar sesuai kebutuhan */
            position: absolute; /* Mengatur posisi absolut untuk gambar */
            top: 20px; /* Penyesuaian top untuk penempatan yang sesuai */
            right: 20px; /* Penyesuaian right untuk penempatan yang sesuai */
            /* Hapus border */
            border: none;
            /* Hapus border-radius jika tidak diperlukan */
            border-radius: 5px; /* Biarkan jika diperlukan untuk sudut yang melengkung */
        }
    </style>
</head>
<body>
    <div class="history-container">
        <h2>Transaction History</h2>
        <?php if (empty($history)): ?>
            <p>No transactions found.</p>
        <?php else: ?>
            <?php foreach($history as $row): ?>
                <div class="transaction-item">
                    <h5>Transaction ID: <?php echo $row['transaction_id']; ?></h5>
                    <ul class="transaction-list">
                        <li><strong>Username:</strong> <?php echo $row['username']; ?></li>
                        <li><strong>Product name:</strong> <?php echo $row['product_name']; ?></li>
                        <li><strong>Quantity:</strong> <?php echo $row['quantity']; ?></li>
                        <li><strong>Name:</strong> <?php echo $row['name']; ?></li>
                        <li><strong>Phone:</strong> <?php echo $row['phone']; ?></li>
                        <li><strong>Address:</strong> <?php echo $row['address']; ?></li>
                        <li><strong>Order Date:</strong> <?php echo $row['order_date']; ?></li>
                        <li><strong>Total:</strong> <?php echo $row['total']; ?></li>
                        <li><strong>Status:</strong> <?php echo $row['status']; ?></li>
                    </ul>
                    <a href="historyPDF.php?id=<?php echo $row['transaction_id']; ?>">Cetak</a>
                    <img src="../img-coffee/<?php echo $row['product_image']; ?>" class="transaction-image" alt="">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>