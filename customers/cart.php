<?php 
    session_start();

    require '../control.php';

    if(isset($_POST["login"])) {
        header("location: ../login.php");
        exit;
    }

    $subtotal = 0;
    
    $cart_product = query("SELECT * FROM cart");

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
                            <ul class="dropdown-menu">
                                <?php foreach($categories as $category) : ?>
                                    <li><a class="dropdown-item" href="categories.php?id=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>
                                <?php endforeach; ?>
                                <li><hr></li>
                                <li><a class="dropdown-item" href="#">All Products</a></li>
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
    <main class="py-5 my-5" style="transform:translateY(20px); height: 630px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 w-75">
                    <div class="shadow p-5 bg-white">
                        <div class="mb-3">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th></th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cart_product as $cart) : ?>
                                        <?php
                                            $product_id = $cart['product_id'];
                                            $subtotal += $cart['total_price'];
                                            $product = mysqli_query($con, "SELECT x.*, y.image FROM product_galleries y INNER JOIN product x ON x.id = y.product_id WHERE x.id = $product_id GROUP BY x.id");
                                            $results = mysqli_fetch_array($product);
                                        ?>
                                        <tr>
                                            <td><img src="../assets/<?= $results['image']; ?>" alt="product" width="70"></td>
                                            <td><h4 class="fs-5"><?= $results['name']; ?></h4></td>
                                            <td>Rp. <?= number_format($results['price'], 2, ',', '.'); ?></td>
                                            <td><?= $cart['amount']; ?></td>
                                            <td>Rp. <?= number_format($cart['total_price'], 2, ',', '.'); ?></td>
                                            <td>
                                                <a href="batal.php?id=<?= $cart['id']; ?>" class="btn btn-danger p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>                                            
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="categories.php" class="btn btn-primary d-block">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-8 w-75">
                    <div class="shadow p-5 bg-white">
                        <h3>Ringkasan Belanja</h3>
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-between">
                                <h4 class="text-muted">Total Harga</h4>
                                <h4>Rp. <?= number_format($subtotal, 2, ',', '.'); ?></h4>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12">
                                <a href="transaction.php" class="btn btn-primary d-block">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="">
        <hr>
        <div class="container text-center">
            <p class="text-muted">Copyright © 2022 | All Right Reserved.</p>
        </div>
    </footer>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>