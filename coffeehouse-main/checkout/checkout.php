<?php 
require_once "checkoutFunctions.php";
$product_id = $_GET['product_id'];
$quantity = $_GET['quantity'];

$checkout = new Checkout();

if(isset($_POST['checkout'])) {
    // Buat objek Checkout
    $checkout = new Checkout();

    // Panggil metode checkout dengan data dari $_POST
    $result = $checkout->checkout($_POST);

    
    if($result > 0) {
        echo "Pesanan berhasil dibuat!";
        // Redirect atau tampilkan pesan sukses, sesuai kebutuhan
    } else {
        echo "Gagal membuat pesanan. Silakan coba lagi.";
        // Tampilkan pesan gagal, sesuai kebutuhan
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../create_account/create_account.css">
</head>
<body>

    <div class="background-image"></div>

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container-custom">
        <div class="card">
            <div class="card-header">
                Buat Akun
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="product_id" class="form-control" id="username" aria-describedby="emailHelp" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" class="form-control" id="username" aria-describedby="emailHelp" value="<?php echo $quantity; ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Nama">
                    </div>
                  <button type="submit" name="checkout" class="btn btn-login">Buat Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>