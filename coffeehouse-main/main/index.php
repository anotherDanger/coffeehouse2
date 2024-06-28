<?php

require_once "../profil/function.php";
require_once "../products/product.php";
require_once "../login/loginfunctions.php";
// Set session from cookie if session is not set but cookie is present
if (isset($_COOKIE['user_id_cookie']) && isset($_COOKIE['id'])) {
  $key = $_COOKIE['id'];
  $user = $_COOKIE['user'];
  $rows = new Profil();
  $row = $rows->getProfil("SELECT * FROM users WHERE username = '$user'")[0];
  $id = $row['username'];
  if($key === hash('sha256', $id))
  {
    $_SESSION['login'] = $user;
  }
}

if (isset($_SESSION['login'])) {
  $profil = new Profil();
  $username = $_SESSION['login'];
  $rows = $profil->getProfil("SELECT * FROM users WHERE username = '$username'");
  $gambar = $profil->getProfil("SELECT * FROM users WHERE username = '$username'")[0];
}

$products = new Product();
$product = $products->getProduct("SELECT * FROM products");
$product1 = $products->getProduct("SELECT * FROM products")[0];



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COFFEE SHOP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="indexStyle.css">
  <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-brown navbar-dark shadow-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="" id="">Patri Coffee Shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-right" id="navbarText">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../blogs/blogs.php">Blogs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#about">about</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#kontak">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <button class="btn btn-profile" type="button" data-bs-toggle="modal" data-bs-target="#profil">
              <i class="fa-solid fa-regular fa-user fa-xl fa-xl text-white"></i>
            </button>
          </li>

          <?php if(isset($_SESSION['login'])): ?>
            <li class="nav-item">
            <button class="btn btn-cart" id="viewCartBtn" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offCanfasCart" aria-controls="offCanfasCart">
              <i class="fa-solid fa-cart-shopping fa-xl text-white"></i>
            </button>
          <?php endif; ?>
          </li>
        </ul>

        </ul>
      </div>
    </div>
  </nav>
  <!-- BANNER -->
  <div class="container-fluid banner" id="home">
    <div class="container ">
      <h4 class="display-1">PATRI COFFEE </h4>
      <h4 class="display-1">HOUSE </h4>
      <H1 class="text-danger">The premium Quality</H1>
      <H3 class="display-7 text-light">Patri house provides seeds</H3>
      <H3 class="display-7 text-light">the best quality coffee</H3>
      <a href="#menu">
        <button type="button" class="btn btn-order-now  btn-lg mt-4 "
          style="text-decoration: none; color:aliceblue;">Order Now</button>
      </a>

    </div>
  </div>

  <!-- Menu -->
  <div class="container-fluid pt-5 menu" id="menu">
    <div class="container text-center ">
      <h2 class="mt-3">Produk</h2>
      <div class="row pt-4 gx-4 gy-4">
        <?php foreach ($product as $row) : ?>
        <!-- CARD 1 -->
        <div class="col-md-4">

          <div class="card crop-img">
            <img src="../img-coffee/<?php echo $row['product_image']; ?>" class="card-image card-img-top">
            <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
            <p class="card-text">Rp. <?php echo $row['product_price']; ?></p>
            <button class="btn btn-view-product mb-3" type="button" data-bs-toggle="modal"
              data-bs-target="#btnModal<?php echo $row['product_id']; ?>">Lihat Produk</button>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>


  <?php foreach ($product as $row) : ?>
  <!-- Modal -->
  <div class="modal fade" id="btnModal<?php echo $row['product_id']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Konten Modal -->
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Header Modal -->
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">KOPI <?php echo $row['product_name']; ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Body Modal -->
        <div class="modal-body">
          <div class="row pt-4">
            <div class="col-md-6">
              <img src="../img-coffee/<?php echo str_replace(' ', '', strtolower($row['product_name'])); ?>.png"
                alt="<?php echo $row['product_name']; ?>" class="gmbr-popup">
            </div>
            <div class="col-md-6">
              <h3>BIJI KOPI <?php echo $row['product_name']; ?> - Patri Coffe House 800gr</h3>
              <p><?php echo $row['product_price']; ?></p>
              <div class="quantity">
                <button class="minus-btn" type="button" data-product-id="<?php echo $row['product_id']; ?>">-</button>
                <input type="text" id="quantity_<?php echo $row['product_id']; ?>" class="quantity-input" value="1">
                <button class="plus-btn" type="button" data-product-id="<?php echo $row['product_id']; ?>">+</button>
              </div>
            </div>
            <div class="col-md-12">
              <p style="padding-top: 10px;">Deskripsi :</p>
              <p><?php echo $row['product_desc']; ?></p>
            </div>
          </div>
        </div>
        <!-- Footer Modal -->
        <div class="modal-footer text-center">
          <?php if (isset($_SESSION['login'])) : ?>
          <?php
              $productId = $row['product_id'];
              $checkoutUrl = '../checkout/checkout.php?product_id=' . $productId . '&quantity=1'; // Default quantity di sini adalah 1
              ?>
          <a href="<?php echo $checkoutUrl; ?>" class="btn-popup text-center text-decoration-none"
            id="checkoutLink_<?php echo $row['product_id']; ?>" data-product-id="<?php echo $productId; ?>">Beli
            Langsung</a>
          <button type="button" class="btn-popup btn-add-to-cart" onclick="addToCart('<?= $productId; ?>')"
            data-product-id="<?php echo $productId; ?>">Tambahkan
            Ke Keranjang</button>
          <?php else : ?>
          <a href="../login/login.php" class="btn text-center text-decoration-none" id="btn-login">Masuk</a>
          <a href="../create_account/create_account.php" class="btn text-center text-decoration-none"
            id="btn-create-account">Buat Akun</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <!-- MODAL LOGIN -->
  <div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <?php if (!isset($_SESSION['login'])) : ?>
          <a href="../create_account/create_account.php" style="text-decoration: none;">
            <p class="text-center">Create Account</p>
          </a>
          <a href="../login/login.php" style="text-decoration: none;">
            <p class="text-center">Masuk</p>
          </a>
          <?php endif; ?>

          <?php if (isset($_SESSION['login'])) : ?>

          <form action="../upload/upload.php" method="post" enctype="multipart/form-data">
            <div class="custom-file-upload-container">
              <div class="custom-file-upload-foto">
                <img src="img/<?php echo $gambar['user_image']; ?>" alt="" class="foto">
                <?php foreach ($rows as $row) : ?>
                <p class="username-user">Halo! . <?php echo $row['username']; ?></p>
                <p>History</p>
                <?php endforeach; ?>
                <div class="custom-file-upload">
                  <input type="file" name="foto" id="foto" />
                  <label for="foto">Pilih Foto</label>
                  <button type="submit" name="upload">upload</button>
                </div>
              </div>

            </div>
          </form>
          <?php foreach ($rows as $row) : ?>
          <div class="link-logout"> <a class="logout" aria-current="page" href="logout.php">Logout</a> </div>
          <?php endforeach; ?>

          <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- About -->
  <div class="container-fluid pt-5 about" id="about">
    <div class="container">
      <h2 class="display-3 text-center text-white" id="tentang">Tentang</h2>
      <p class="text-center text-white">Patri Coffee House</p>
      <div class="pt-5 text-white">
        <img src="../img-coffee/abaout.png" class="col-md-6 float-md-end mb-3 crop-img img-fluid img-about" />
        <p>Patri Coffee House didirikan dengan komitmen untuk mendukung dan memberdayakan petani kopi. Aspek ini menjadi
          salah satu alasan utama di balik pendirian Patri Coffee House.</p>
        <p>Dengan memberikan dukungan kepada petani kopi, Patri Coffee House berusaha menciptakan dampak positif pada
          masyarakat dan industri kopi secara keseluruhan.</p>
        <p>Dengan fokus pada dukungan kepada petani kopi, Patri Coffee House menciptakan ekosistem yang saling
          menguntungkan di mana para petani mendapatkan nilai lebih dari hasil kerja mereka, sementara pelanggan dapat
          menikmati kopi berkualitas tinggi yang bersumber secara etis. Melalui komitmen ini, Patri Coffee House
          berharap dapat memberikan dampak positif pada industri kopi dan mendorong perubahan yang lebih baik bagi
          petani kopi di seluruh dunia.</p>
      </div>
    </div>
  </div>
  <!-- Take ud with you -->
  <div class="container-fluid pt-5 pb-5">
    <div class="container text-center">
      <p class="display-6">Take us with you</p>
      <h1 class="display-5 fw-bold text-secondary">Bawa Kami Dalam Keseharian Bersamamu</h1>
      <div class="row pt-5 pb-5">
        <div class="col-md-4">
          <span class="lingkaran mb-5"><i class="fa-solid fa-bag-shopping fa-5x"></i></span>
          <h2>Coffe Pack</h2>
          <p>Dalam Kemasan 800gr kamu bisa menikmati secangkir kopi dari patri kopi house </p>
        </div>
        <div class="col-md-4">
          <span class="lingkaran mb-5"><i class="fa-solid fa-bag-shopping fa-5x"></i></span>
          <h3>Selected Coffee Beans</h3>
          <p>Dapatkan berbagai pilihan biji kopi premium dari berbagai daerah untuk memenuhi selera kopimu.</p>
        </div>
        <div class="col-md-4">
          <span class="lingkaran mb-5"><i class="fa-solid fa-bag-shopping fa-5x"></i></span>
          <h2>Hampers</h2>
          <p>Dapatkan berbagai pilihan biji kopi premium dari berbagai daerah untuk memenuhi selera kopimu.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Gallery -->
  <div class="conatiner-fluid mb-5">
    <div class="container text-center">
      <h2>Gallery</h2>
      <div class="row pt-5 pb-5">
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album1.jpg" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album2.webp" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album3.jpg" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album4.jpg" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album5.webp" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album6.jpg" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album7.jpg" alt="">
          </div>
        </div>
        <div class="col-3">
          <div class="gallery-item">
            <img class="album" src="../img-coffee/album8.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- kontak -->
  <?php if (isset($_SESSION['login'])) : ?>
  <form action="../message/message.php" method="post">
    <div class="container-fluid  kontak">
      <div class="container">
        <h2 class="display-3 text-center" id="kontak">Kontak Kami</h2>
        <p class="text-center">
          Selamat Datang di patri coffe house jika ada pertanyaan hubungi kami melalui form di bawah ini
        </p>
        <div class="row pb-3">
          <div class="col-md-6">
            <input class="form-control form-control-lg mb-3" type="text" name="nama" placeholder="Nama" />
            <input class="form-control form-control-lg mb-3" type="text" name="email" placeholder="Email" />
            <input class="form-control form-control-lg" type="text" name="noHp" placeholder="No. Phone" />
          </div>
          <div class="col-md-6">
            <textarea class="form-control form-control-lg" rows="5" name="message"></textarea>
          </div>
        </div>
        <div class="col-md-3 mx-auto text-center pb-5 pb-5 ">
          <button type="submit" name="kirim" class="btn btn-kirim-pesan btn-lg text-white">
            Kirim Pesan
          </button>
        </div>

      </div>

    </div>
  </form>
  <?php endif; ?>
  <div class="text-center text-white footer">
    All Rights Reserved &copy; 2025
  </div>


  <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanfasCart" aria-labelledby="offCanfasCartLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel" class="mb-0">Keranjang Belanja</h5>
        <a href="../checkout/history.php" class="history-icon text-decoration-none">
            <i class="fas fa-history"></i>
        </a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="cartBody">
        Loading...
        
    </div>
</div>


  <script src="external.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script>
  function addToCart(product_id) {
    const quantity = $('#quantity_' + product_id).val();

    $.ajax({
      url: '../cart/add_to_cart.php',
      type: 'POST',
      data: {
        product_id: product_id,
        quantity: quantity
      },
      success: function(response) {
        alert('Produk ditambahkan');
        console.log(response);
      },
      error: function(xhr, status, error) {
        alert('Gagal menambahkan!');
        console.error(xhr.responseText);
      }
    });
  }

  $(document).ready(function() {
    function getCart() {
      $.ajax({
        url: '../cart/cart.php',
        type: 'GET',
        success: function(response) {
          $('#cartBody').html(response);
        },
        error: function(xhr, status, error) {
          $('#cartBody').html('<p>Terjadi kesalahan ketika mengambil data keranjang.</p>');
          console.error(xhr.responseText);
        }
      });
    }

    $('#viewCartBtn').click(function() {
      getCart();
    });

    $(document).on('click', '#clearCartBtn', function() {
      $.ajax({
        url: '../cart/clear_cart.php',
        type: 'POST',
        success: function(response) {
          alert('Keranjang berhasil dihapus!');
          $('#cartBody').html('<p>Keranjang kamu kosong!</p>');
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan saat menghapus keranjang.');
          console.error(xhr.responseText);
        }
      });
    });

    $(document).on('click', '.delete-item-btn', function() {
      const productId = $(this).data('product-id');
      $.ajax({
        url: '../cart/delete_cart_item.php',
        type: 'POST',
        data: {
          product_id: productId
        },
        success: function(response) {
          alert('Produk berhasil dihapus!');
          getCart();
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan saat menghapus produk.');
          console.error(xhr.responseText);
        }
      });
    });
    $(document).on('click', '.checkout-item-btn', function() {
    const productId = $(this).data('product-id');
    const quantity = $('#quantity_' + productId).val(); // Ambil kuantitas produk dari input

    // Lakukan redirect ke halaman checkout dengan menyertakan product_id dan quantity
    window.location.href = '../checkout/checkout.php?product_id=' + productId + '&quantity=' + quantity;
  });
  });
  </script>
</body>

</html>