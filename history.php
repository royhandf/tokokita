<?php 
    session_start();

    require 'control.php';

    $products = query("SELECT y.*, x.image FROM product_galleries x INNER JOIN product y ON x.product_id = y.product_id GROUP BY x.product_id LIMIT 4");
    $categories = query("SELECT * FROM categories");
    // var_dump($categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokita</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
                            <?php foreach($categories as $category) : ?>
                                <li><a class="dropdown-item" href="categories.php?id=<?= $category['id']; ?>"><?= $category['category_name']; ?></a></li>
                            <?php endforeach; ?>
                            <li><hr></li>
                            <li><a class="dropdown-item" href="categories.php">All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-1">
                        <a href="register.php" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-10">
                    <div class="m-4 p-5 text-white rounded bg-info">
                        <div class="container hero text-center">
                            <h1>Selamat Datang</h1>
                            <p>Menyediakan berbagai barang tentang basket</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-3">
                <div class="col-lg-12 col-md-10 text-center">
                    <h1>Best Product</h1>
                    <p>Ini adalah produk terbaik yang ada sajikan</p>
                </div>  
            </div>
            <div class="row">
                <?php foreach($products as $product) : ?>
                    <div class="col-lg-3 col-md-4 mb-3">
                        <div class="card shadow">
                            <img src="../assets/<?= $product['image']; ?>" class="card-img-top w-75 mx-auto" alt="product">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $product['name']; ?></h5>
                                <p class="card-text">Rp. <?= $product['price']; ?></p>
                                <a href="product.php?id=<?= $product['product_id']; ?>" class="btn btn-primary">Tambah</a>
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

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>