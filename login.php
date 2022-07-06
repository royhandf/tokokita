<?php 
    session_start();

    require 'connection.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // cek apakah admin atau user
        $account = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email'");
            if (mysqli_num_rows($account) > 0) {
                $data = mysqli_fetch_assoc($account);

                // cek password
                if (password_verify($password, $data['password'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['id'] = $data['id'];
                    
                    header('location: admin/home.php');
                    exit;
                }
            }

        $account = mysqli_query($con, "SELECT * FROM customer WHERE email = '$email'");
        if (mysqli_num_rows($account) > 0) {
            $data = mysqli_fetch_assoc($account);

            // cek password
            if (password_verify($password, $data['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['name'] = $data['name'];
                $_SESSION['id'] = $data['id'];

                header('location: customers/home.php');
                exit;
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokita - Login</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid vh-100" style="background-color: #f5f5f5;">
        <div class="card position-absolute top-50 start-50 translate-middle" style="border-radius: 15px; width: 25%;">
            <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-4">Sign In</h2>
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"> 
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"> 
                    </div>
                    <button type="submit" name="login" class="btn btn-primary mt-2">Sign In</button>
                    <p class="text-center text-muted mt-5 mb-0">Sudah punya akun?
                        <a href="register.php" class="fw-bold text-body"><u>Sign Up</u></a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>