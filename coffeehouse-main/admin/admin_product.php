<?php 

require_once "../products/product.php";
$products = new Product();
$product = $products->getProduct("SELECT * FROM products");
$product1 = $products->getProduct("SELECT * FROM products")[0];

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
      <p>username : </p>
      <p>email : </p>
      
      <form method="post" class="logout">
        <button name="logout" class="logout-btn">LOG OUT</button>
      </form>
    </div>

    <!-- Products -->
     <!-- tambah product -->
     <div class="button-container">
        <button class="floating-btn" data-bs-toggle="modal" data-bs-target="#tambah-product">
          <i class="fas fa-plus"></i>
        </button>
        <div class="tooltip-text"></div>
     </div>
        <!------------- Modal Product ----------->
<div class="modal fade" id="tambah-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <section class="add-products">
          <form action="" method="post" enctype="multipart/form-data">
              <h1 class="title">Add New Product</h1>
              <div class="input-field">
                  <label for="">Nama biji kopi</label>
                  <input type="text" name="name" required>
              </div>
              <div class="input-field">
                  <label for="">Harga biji kopi</label>
                  <input type="text"name="price" required>
              </div>
              <div class="input-field">
                  <label for="">Deskripsi</label>
                  <textarea name="detail" id="" required></textarea>
              </div>
              <div class="input-field">
                  <label for="">Foto biji kopi</label>
                  <input type="file" name="image" accept="image/jpg, image/png, image/jpeg, image/webp" required>
              </div>
                  <input type="submit" name="add_product" value="Simpan" class="btn-add-product">
          </form>
      </section>
      </div>
    </div>
  </div>
</div>


        <!------- show products section ------->
        
        <h2 class="titlee">Total Products</h2>
        <div class="box-container">
          
        <?php foreach($product as $row): ?>
                <div class="box">
                  <img class="image" src="img-admin/back1.jpg" alt="image kopi">
                  <h4><?php echo $row['product_name']; ?></h4>
                  <p><?php echo $row['product_price']; ?></p>
                  
                  <a href="admin_product.php" class="edit" data-bs-toggle="modal" data-bs-target="#edit-product" >Edit</a>
                  <a href="admin_product.php" class="delete" onclick="return confirm('delete this')">Delete</a>
                </div>
                <?php endforeach; ?>
        </div>
              
        <!-- Modal edit product-->
        <div class="modal fade" id="edit-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
          
              <section class="update-container">   

                <form action="admin_product.html" method="post" enctype="multipart/form-data">
                  <img src="img-admin/back3.jpg" alt="gambar coffe">
                  <input type="hidden" name="update_p_id " value="">
                  <input type="text" name="update_p_name " value="<?php echo $product1['product_name']; ?>">
                  <input type="number" min="0" name="update_p_proce " value="">
                  <textarea name="update_p_detail " value=""> </textarea>
                  <input type="file" name="update_p_image " accept="image/png,image/jpg,image/jpeg,image/webp">
                  <input type="submit" name="update_produvt " value="update" class="edit">
                  <input type="reset"  value="cancel" class="edit" id="close-edit" data-bs-dismiss="modal">
                </form>                
              </section>
            
          </div>
        </div>
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