document.addEventListener("DOMContentLoaded", function() {

    // Menangani perubahan input quantity
    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var productId = this.id.replace('quantity_', ''); // Ambil productId dari id input
            var quantity = parseInt(this.value); // Ambil nilai quantity yang baru
            updateCheckoutLink(productId, quantity); // Panggil fungsi untuk update tautan checkout
            updateCartUrl(productId, quantity); // Panggil fungsi untuk update tautan cart
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
            updateCartUrl(productId, currentValue + 1); // Panggil fungsi untuk update tautan cart
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
                updateCartUrl(productId, currentValue - 1); // Panggil fungsi untuk update tautan cart
            }
        });
    });
    
    // Fungsi untuk update tautan cart
function updateCartUrl(productId, quantity) {
    var cartLink = document.getElementById('cartLink_' + productId); // Ambil elemen link cart berdasarkan productId
    cartLink.href = '../checkout/checkoutAction.php?product_id=' + productId + '&quantity=' + encodeURIComponent(quantity); // Update href link cart dengan productId dan quantity yang baru
}
});