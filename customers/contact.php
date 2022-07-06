<?php 
    session_start();

    require '../control.php';

    if(!isset($_SESSION["login"])) {
        header("Location: ../index.php");
        exit;
    }

    $id = $_SESSION['id'];

    $products = query("SELECT y.*, x.image FROM product_galleries x INNER JOIN product y ON x.product_id = y.id GROUP BY x.product_id ORDER BY x.product_id LIMIT 4");
    $categories = query("SELECT * FROM categories");
    $customer = query("SELECT * FROM customer WHERE id = $id")[0];
    
    if(isset($_POST['send'])) {
        if(report($_POST) > 0 ) {
            echo "
                <script> 
                    alert('Data berhasil dikirim!')
                </script>
            ";
        } else {
            echo "
                <script> 
                    alert('Data gagal dikirim!')
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokita</title>
    <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-white navbar-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">Tokokita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach($categories as $category) : ?>
                                <li><a class="dropdown-item" href="categories.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>
                            <?php endforeach; ?>
                            <li><hr></li>
                            <li><a class="dropdown-item" href="categories.php">All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link active">Contact</a>
                    </li>
                </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ms-5">
                            <a href="cart.php" class="nav-link">
                            <svg class="mb-1 me-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-capitalize" role="button" data-bs-toggle="dropdown"><?= $_SESSION['name']; ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="history.php" class="dropdown-item">History</a></li>
                                <li><a href="/logout.php" class="dropdown-item">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>
    <main class="py-5 mt-5">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-10 col-md-9">
            <div class="shadow py-3 bg-white rounded">
                <div class="row justify-content-center mb-1">
                    <div class="col-lg-3 col-md-5 text-center my-3">
                        <svg class="svg-inline--fa fa-phone-alt fa-w-16 mb-3" width="50px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path></svg>
                        <h4>Phone</h4>
                        <div class="text-muted">
                            +62-81239681997
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 text-center my-3">
                        <svg class="svg-inline--fa fa-map-marker-alt fa-w-12 mb-3" width="50px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>
                        <h4>Address</h4>
                        <div class="text-muted">
                            Perum. Karya Bhakti P-13 Kota Pasuruan
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 text-center my-3">
                        <svg class="svg-inline--fa fa-clock fa-w-16 mb-3" width="50px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg>
                        <h4>Open Time</h4>
                        <div class="text-muted">
                            24 Hours
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 text-center my-3">
                        <svg class="svg-inline--fa fa-envelope fa-w-16 mb-3" width="50px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg><!-- <i class="fas fa-envelope mb-3"></i> Font Awesome fontawesome.com -->
                        <h4>Email</h4>
                        <div class="text-muted">
                            tokokita@gmail.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-9">
            <div class="shadow bg-white p-3 text-center rounded">
                <div class="alert alert-success alert-dismissible fade show d-none alert-kirim" role="alert">
                    <strong>Thank you!</strong> Your message has been sent.
                </div>
                <h3>Send Us a Message</h3>
                <div class="my-5">
                    <form action="" method="POST">
                        <div class="row justify-content-between mb-3">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" name="name" value="<?= $customer['name']; ?>">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="<?= $customer['email']; ?>">
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" placeholder="Masukkan pesan Anda" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <button type="submit" name="send" class="btn btn-primary w-100">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </main>
    <footer class="mt-5">
        <hr>
        <div class="container text-center">
            <p class="text-muted">Copyright © 2022 | All Right Reserved.</p>
        </div>
    </footer>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>