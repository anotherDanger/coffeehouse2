<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>

<div class="container-fluid container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Masuk Sebagai Admin
                </div>
                <div class="card-body">
                    <form action="loginfunctions.php" method="post">
                    <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
                            <p style="color: red; font-style: italic;"><?php echo $_SESSION['error']; ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name ="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name ="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <button type="submit" name="login" class="btn btn-login">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>