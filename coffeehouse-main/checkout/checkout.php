<?php 
require_once "checkoutFunctions.php";
$product_id = $_GET['product_id'];
$quantity = $_GET['quantity'];

$checkout = new Checkout();

if(isset($_POST['checkout'])) {
   
    $checkout = new Checkout();


    $result = $checkout->checkout($_POST);

    
    if($result > 0) {
        echo "Pesanan berhasil dibuat!";

    } else {
        echo "Gagal membuat pesanan. Silakan coba lagi.";

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .icon-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1rem;
        }

        .icon-container img {
            max-width: 15%;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card">
            <div class="card-header">
                Checkout
            </div>
            <div class="card-body">
                <form action="checkoutAction.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Phone</label>
                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="No HP">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat">
                    </div>
                    <div class="icon-container">
                        <img src="spay.png" alt="ShopeePay" data-bs-toggle="modal" data-bs-target="#spayModal">
                        <img src="gpay.png" alt="Google Pay" data-bs-toggle="modal" data-bs-target="#gpayModal">
                        <img src="dana1.png" alt="DANA" data-bs-toggle="modal" data-bs-target="#danaModal">
                    </div>
                    <button type="submit" name="checkout" class="btn btn-custom w-100">Buat Pesanan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ShopeePay Modal -->
    <div class="modal fade" id="spayModal" tabindex="-1" aria-labelledby="spayModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="spayModalLabel">ShopeePay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Silahkan selesaikan pembayaran ke nomor 08xxxxxx.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Pay Modal -->
    <div class="modal fade" id="gpayModal" tabindex="-1" aria-labelledby="gpayModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gpayModalLabel">GoPay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Silahkan selesaikan pembayaran ke nomor 08xxxxxx.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DANA Modal -->
    <div class="modal fade" id="danaModal" tabindex="-1" aria-labelledby="danaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="danaModalLabel">DANA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Silahkan selesaikan pembayaran ke nomor 08xxxxxx.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

