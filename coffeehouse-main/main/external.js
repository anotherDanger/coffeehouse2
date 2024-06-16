document.addEventListener("DOMContentLoaded", function() {
    // Event listener untuk perubahan langsung pada input quantity
    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var productId = this.id.replace('quantity_', '');
            var quantity = parseInt(this.value);
            updateCheckoutLink(productId, quantity);
        });
    });

    // Event listener untuk tombol tambah produk
    document.querySelectorAll('.plus-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            var quantityInput = document.getElementById('quantity_' + productId);
            var currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
            updateCheckoutLink(productId, currentValue + 1);
        });
    });

    // Event listener untuk tombol kurang produk
    document.querySelectorAll('.minus-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            var quantityInput = document.getElementById('quantity_' + productId);
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateCheckoutLink(productId, currentValue - 1);
            }
        });
    });

    // Fungsi untuk memperbarui link "Beli Langsung"
    function updateCheckoutLink(productId, quantity) {
        var checkoutLink = document.getElementById('checkoutLink_' + productId);
        checkoutLink.href = '../checkout/checkout.php?product_id=' + productId + '&quantity=' + encodeURIComponent(quantity);
    }
});