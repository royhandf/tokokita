<?php 
    session_start();

    require 'control.php';

    if(empty($_GET['id'])) {
        $products = query("SELECT y.*, x.image FROM product_galleries x 
                        INNER JOIN product y ON x.product_id = y.id
                        GROUP BY x.product_id");
    } else {
        $id  = $_GET['id'];
        $products = query("SELECT y.*, x.image FROM product_galleries x 
                        INNER JOIN product y ON x.product_id = y.id 
                        WHERE y.category_id = $id
                        GROUP BY x.product_id");
    }
    $categories = query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokokita</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-white navbar-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">Tokokita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach($categories as $category) : ?>
                                <li><a class="dropdown-item" href="categories.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>
                            <?php endforeach; ?>
                            <li><hr></li>
                            <li><a class="dropdown-item" href="categories.php?id=">All Products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
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
            <div class="row justify-content-center my-4">
                <div class="col-lg-10 col-md-8">
                    <div class="input-group">
                        <form action="" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Search" size="300">
                                <button type="submit" name="search" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row justify-content-start">
                <?php foreach($products as $product) : ?>
                    <div class="col-lg-3 col-md-4 mb-4 card-group">
                        <div class="card shadow" style="height: 100%;">
                            <img src="../assets/<?= $product['image']; ?>" class="card-img-top w-75 mx-auto" alt="product">
                            <div class="card-body text-center">
                                <h5 class="card-title px-2"><?= $product['name']; ?></h5>
                                <p class="card-text">Rp. <?= number_format($product['price'], 2, ',', '.'); ?></p>
                                <a href="login.php" class="btn btn-dark">Check Product</a>
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