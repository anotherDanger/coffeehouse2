<?php 
session_start();
require_once "adminFunctions.php";

$transc = new Admin();
$orders = $transc->getQuantity("SELECT * FROM transactions");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin - Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-nav fixed-top shadow-lg">
    <div class="container-fluid">
      <a class="navbar-brand pannel-admin text-white" href="#">Halaman Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 mx-auto ">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="admin_home.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="admin_product.html">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="admin_orders.html">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="admin_users.html">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="admin_messages.html">Messages</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
          <li class="nav-item nav-user">
            <a href=""><i class="fa-regular fa-user fa-xl" id="profile-icon"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- logout -->
    <div class="user-box" id="user-box">
      <p>username : <span><?php echo $_SESSION ['admin_name'];?></span></p>
      <p>email : <span><?php echo $_SESSION ['admin_email'];?></span></p>
      
      <form method="post" class="logout">
        <button name="logout" class="logout-btn">LOG OUT</button>
      </form>
    </div>
    <!-- ------orders---------- -->
    <!-- Yang di pakai -->
    <?php foreach($orders as $row): ?>
      <form action="" method="post">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id'] ?>">
    <section class="order-container">
      <h1 class="title">Total Pesanan</h1>
      <div class="box-container">
        <div class="box">
          <p>Transaction ID : <?php echo $row['transaction_id']; ?></p>
          <p>User id : <?php echo $row['user_id'] ?></p>
          <p>Product Name : <?php echo $row['product_name'] ?></p>
          <p>Quantity : <?php echo $row['quantity'] ?></p>
          <select name="status" id="">
            <option disabled selected></option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select><br><br><br>
        <button type="submit" name="update" class="edit">update</button>
          <a href="admin_orders.html" class="delete" onclick="return confirm('delete this')">Delete</a>
        </div> 
      </section>
    </form>
    <?php endforeach; ?>
     <script>
      document.getElementById('profile-icon').addEventListener('click', function(event){
        event.preventDefault();
        var userBox = document.getElementById('user-box')
        userBox.classList.toggle('active');
      });
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>