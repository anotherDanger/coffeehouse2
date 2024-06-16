<?php 
require_once "signup.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="create_account.css">
</head>
<body>

    <div class="background-image"></div>

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container-custom">
        <div class="card">
            <div class="card-header">
                Buat Akun
            </div>
            <div class="card-body">
                <form action="create_account.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Konfirmasi Password">
                    </div>
                  <button type="submit" name="submit" class="btn btn-login">Buat Akun</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>