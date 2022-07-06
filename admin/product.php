<?php 
    session_start();

    require '../control.php';

    if(!isset($_SESSION["login"])) {
        header("Location: ../index.php");
        exit;
    }

    $id = $_GET['id'];

    $categories = query("SELECT * FROM categories");
    $products = query("SELECT * FROM product WHERE product_id = $id");
    $galleries = query("SELECT DISTINCT id, image FROM product_galleries WHERE product_id = $id ORDER BY id DESC LIMIT 2");
    $thumbnails = query("SELECT image FROM product_galleries WHERE product_id = $id LIMIT 1");
    
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
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ms-5">
                            <a href="#" class="nav-link">
                            <svg class="mb-1 me-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-capitalize" role="button" data-bs-toggle="dropdown"><?= $_SESSION['name']; ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="dashboard/dashboard.php" class="dropdown-item">Dashboard</a></li>
                                <li><a href="history.php" class="dropdown-item">History</a></li>
                                <li><a href="/logout.php" class="dropdown-item">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>
    <main class="py-4" id="product">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 mb-3 mx-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach($thumbnails as $thumbnail) :?>
                                        <div class="carousel-item active">
                                            <img src="../assets/<?= $thumbnail['image']; ?>" alt="<?= $thumbnail['image']; ?>" class="d-block w-100">
                                        </div>
                                    <?php endforeach; ?>
                                    <?php foreach($galleries as $key => $gallery) : ?>
                                        <div class="carousel-item">
                                            <img src="../assets/<?= $gallery['image']; ?>" alt="<?= $gallery['image']; ?>" class="d-block w-100">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mt-4">
                    <?php foreach($products as $product): ?>
                        <h1><?= $product['name'] ?></h1>
                        <h3 class="text-danger">Rp. <?= number_format($product['price'], 2, ',', '.'); ?></h3>
                        <br>
                        <p><?= $product['description']; ?></p>
                        <div class="mt-5">
                            <form action="" method="POST">
                                <div class="row">
                                    <?php if($product['stock'] == 1) : ?>
                                        <p class="text-danger fs-6">Last item on stock!</p>
                                    <?php endif;  ?>
                                    <label for="qyt" class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="qyt" id="qyt" value="1" class="form-control mb-3">
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" name="addCart" class="btn btn-dark">Add to Cart</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
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

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>