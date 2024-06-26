document.addEventListener("DOMContentLoaded", function() {
    // Menangani perubahan input quantity
    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var productId = this.id.replace('quantity_', ''); // Ambil productId dari id input
            var quantity = parseInt(this.value); // Ambil nilai quantity yang baru
            updateCheckoutLink(productId, quantity); // Panggil fungsi untuk update tautan checkout
            updatecartLink(productId, quantity); // Panggil fungsi untuk update tautan keranjang
        });
    });

    // Menangani penambahan quantity
    document.querySelectorAll('.plus-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id'); // Ambil productId dari atribut data-product-id
            var quantityInput = document.getElementById('quantity_' + productId); // Ambil input quantity berdasarkan productId
            var currentValue = parseInt(quantityInput.value); // Ambil nilai quantity saat ini
            quantityInput.value = currentValue + 1; // Tambahkan 1 ke nilai quantity
            updateCheckoutLink(productId, currentValue + 1); // Panggil fungsi untuk update tautan checkout
            updatecartLink(productId, currentValue + 1); // Panggil fungsi untuk update tautan keranjang
        });
    });

    // Menangani pengurangan quantity
    document.querySelectorAll('.minus-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id'); // Ambil productId dari atribut data-product-id
            var quantityInput = document.getElementById('quantity_' + productId); // Ambil input quantity berdasarkan productId
            var currentValue = parseInt(quantityInput.value); // Ambil nilai quantity saat ini
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1; // Kurangi 1 dari nilai quantity jika lebih dari 1
                updateCheckoutLink(productId, currentValue - 1); // Panggil fungsi untuk update tautan checkout
                updatecartLink(productId, currentValue - 1); // Panggil fungsi untuk update tautan keranjang
            }
        });
    });

    // Menangani tombol Tambah ke Keranjang
    document.querySelectorAll('.btn-add-to-cart').forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah aksi bawaan dari tombol link
            
            var productId = this.getAttribute('data-product-id'); // Ambil productId dari atribut data-product-id
            var quantityInput = document.getElementById('quantity_' + productId); // Ambil input quantity berdasarkan productId
            var quantity = parseInt(quantityInput.value); // Ambil nilai quantity saat ini
            
            // Panggil fungsi untuk tambahkan ke keranjang
            addToCart(productId, quantity);
        });
    });

    // Fungsi untuk update tautan checkout
    function updateCheckoutLink(productId, quantity) {
        var checkoutLink = document.getElementById('checkoutLink_' + productId); // Ambil elemen link checkout berdasarkan productId
        checkoutLink.href = '../checkout/checkout.php?product_id=' + productId + '&quantity=' + encodeURIComponent(quantity); // Update href link checkout dengan productId dan quantity yang baru
    }

    // Fungsi untuk update tautan keranjang
function updatecartLink(productId) {
    var quantityInput = document.getElementById('quantity_' + productId); // Ambil input quantity berdasarkan productId
    var quantity = parseInt(quantityInput.value); // Ambil nilai quantity dari input

    var cartLink = document.getElementById('cartLink_' + productId); // Ambil elemen link keranjang berdasarkan productId
    cartLink.href = 'add_to_cart.php?product_id=' + productId + '&quantity=' + encodeURIComponent(quantity); // Update href link keranjang dengan productId dan quantity yang baru
}

    // Fungsi untuk tambahkan produk ke keranjang
    function addToCart(productId, quantity) {
        var username = '<?php echo isset($_SESSION["login"]) ? $_SESSION["login"] : ""; ?>'; // Ambil username dari session PHP
        var productName = document.getElementById('product_name_' + productId).textContent.trim(); // Ambil nama produk dari teks konten
        var url = 'add_to_cart.php?product_id=' + productId + '&username=' + username + '&product_name=' + encodeURIComponent(productName) + '&quantity=' + encodeURIComponent(quantity); // URL untuk add_to_cart.php dengan parameter yang sesuai
        window.location.href = url; // Redirect ke halaman add_to_cart.php dengan parameter yang sudah disiapkan
    }

});