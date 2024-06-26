// Fungsi untuk mengatur ulang nilai quantity menjadi 1
function resetQuantity() {
    var quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(function(input) {
        input.value = 1;
    });
}

// Event listener untuk mendeteksi saat halaman dimuat
window.onload = function() {
    // Panggil fungsi resetQuantity saat halaman dimuat
    resetQuantity();
};