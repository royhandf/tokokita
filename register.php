<?php 
    require 'config.php';

    if (isset($_POST['register'])) {
        if (account($_POST) > 0) {
            echo "<script>
                    alert('Successful');
                    document.location.href = 'login.php';
                </script>";
        } else {
            echo mysqli_errno($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokita - Register</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid vh-100" style="background-color: #f5f5f5;">
        <div class="card position-absolute top-50 start-50 translate-middle" style="border-radius: 15px; width:25%;">
            <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-4">Sign Up</h2>
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"> 
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"> 
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"> 
                    </div>
                    <div class="mb-2">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"> 
                    </div>

                    <button type="submit" name="register" class="btn btn-primary mt-2">Sign Up</button>

                    <p class="text-center text-muted mt-5 mb-0">Sudah punya akun?
                        <a href="login.php" class="fw-bold text-body"><u>Sign In</u></a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>