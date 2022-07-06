<?php 
    session_start();

    require '../control.php';

    if(!isset($_SESSION["login"])) {
        header("Location: ../index.php");
        exit;
    }

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
    <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-white navbar-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">Tokokita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapseCategory">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="home.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu">
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
                                <a href="product.php?id=<?= $product['id']; ?>"  class="btn btn-dark">Check Product</a>
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