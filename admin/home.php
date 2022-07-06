<?php
session_start();

require '../control.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

$categories = query("SELECT * FROM categories");

$products = query("SELECT y.*, x.image FROM product_galleries x INNER JOIN product y ON x.product_id = y.id GROUP BY x.product_id ORDER BY x.product_id LIMIT 4");
// var_dump($thumbnail);
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
            <a class="navbar-brand" href="#">Tokokita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($categories as $category) : ?>
                                <li><a class="dropdown-item" href="categories.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>
                            <?php endforeach; ?>
                            <li>
                                <hr>
                            </li>
                            <li><a class="dropdown-item" href="categories.php">All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ms-5">
                        <a href="#" class="nav-link">
                            <svg class="mb-1 me-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-capitalize" role="button" data-bs-toggle="dropdown"><?= $_SESSION['name']; ?></a>
                        <ul class="dropdown-menu">
                            <li><a href="dashboard/dashboard.php" class="dropdown-item">Dashboard</a></li>
                            <li><a href="#" class="dropdown-item">History</a></li>
                            <li><a href="/logout.php" class="dropdown-item">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container-fluid" style="padding: 0; ">
            <div class="row justify-content-center">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://d3998kv9mq5thy.cloudfront.net/1653463817269.jpeg" class="d-block w-100" alt="gambar1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://d3998kv9mq5thy.cloudfront.net/1653276499922.jpeg" class="d-block w-100" alt="gambar2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://d3998kv9mq5thy.cloudfront.net/1650949583735.jpeg" class="d-block w-100" alt="gambar3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-12 col-md-10 text-center">
                    <h1>Best Product</h1>
                    <p>Ini adalah produk terbaik yang ada sajikan</p>
                </div>
            </div>
            <div class="row justify-content-center mx-3">
                <?php foreach ($products as $product) : ?>
                    <div class="col-lg-3 col-md-4">
                        <div class="card shadow h-100">
                            <img src="../assets/<?= $product['image']; ?>" class="card-img-top w-75 mx-auto" alt="product">
                            <div class="card-body text-center">
                                <h5 class="card-title px-4"><?= $product['name']; ?></h5>
                                <p class="card-text">Rp. <?= number_format($product['price'], 2, ',', '.'); ?></p>
                                <a href="product.php?id=<?= $product['id']; ?>" class="btn btn-dark mb-3">Check Product</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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