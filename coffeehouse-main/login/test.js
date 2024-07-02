document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", function(event) {
        // Prevent form submission
        event.preventDefault();

        // Simulate loading (1.5 detik)
        setTimeout(() => {
            loginForm.submit();
        }, 1500); // Ganti dengan aksi yang sesuai setelah submit, misalnya redirect ke halaman lain
    });
});