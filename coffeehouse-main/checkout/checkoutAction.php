<?php 
require_once "checkoutFunctions.php";

$checkout = new Checkout();

if (isset($_POST['checkout'])) {
    $result = $checkout->checkout($_POST);
    $redirectUrl = "../main/index.php"; // URL untuk redirect
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Checkout Status</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                font-family: Arial, sans-serif;
                background: #f4f4f4;
            }
            .message-container {
                text-align: center;
                position: relative;
                bottom: -50px; /* Initial position below */
                opacity: 0;
                transition: bottom 1s ease-out, opacity 1s ease-out;
            }
            .message-container img {
                width: 100px;
                height: 100px;
                animation: popUp 1s ease-out forwards;
            }
            .message-container p {
                font-size: 36px;
                margin-top: 20px;
                opacity: 0;
                transition: opacity 0.5s ease-out;
            }
            .success {
                color: #3c763d;
            }
            .error {
                color: #a94442;
            }
            @keyframes popUp {
                0% {
                    transform: translateY(100px); /* Initial position below */
                    opacity: 0;
                }
                70% {
                    transform: translateY(-20px); /* Slight bounce effect */
                }
                100% {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
    </head>
    <body>
        <div class="message-container <?php echo $result > 0 ? 'success' : 'error'; ?>">
            <?php
            if ($result > 0) {
                echo '<img src="success.png" alt="Success Icon">';
                echo "<p>Pesanan berhasil dibuat!</p>";
            } else {
                echo '<img src="error_icon.png" alt="Error Icon">';
                echo "<p>Gagal membuat pesanan. Silakan coba lagi.</p>";
            }
            ?>
        </div>
        <script>
            // JavaScript untuk menggerakkan elemen dan mengarahkan pengguna setelah animasi selesai
            document.addEventListener('DOMContentLoaded', function() {
                var messageContainer = document.querySelector('.message-container');
                var messageText = messageContainer.querySelector('p');

                // Memastikan elemen muncul di tengah layar
                messageContainer.style.bottom = '0';
                messageContainer.style.opacity = '1';
                messageText.style.opacity = '1';

                setTimeout(function() {
                    window.location.href = "<?php echo $redirectUrl; ?>";
                }, 3000); // Redirect setelah 3 detik
            });
        </script>
    </body>
    </html>
    <?php
}
?>