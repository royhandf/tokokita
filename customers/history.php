<?php 
    session_start();

    require '../control.php';

    $id = $_SESSION['id'];
    $no = 0;

    $categories = query("SELECT * FROM categories");
    $histories = query("SELECT x.id, z.name, y.amount, p.payment_method, x.status, x.total_price, x.createAt FROM checkout x 
                        INNER JOIN cart y ON x.cart_id = y.id
                        INNER JOIN product z ON y.product_id = z.id 
                        INNER JOIN payment p ON p.id = x.payment_id
                        WHERE x.customer_id = $id
                        ");
    // var_dump($histories);
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
                                <li><a class="dropdown-item" href="categories.php">All Products</a></li>
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
                        <li class="nav-item dropdown ">
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
    <main class="py-4" style="transform:translateY(4rem); min-height: 650px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-8">
                    <div class="shadow p-5 rounded bg-white mb-5">
                        <h4><strong>Order History</strong></h4>
                            <table class="table text-center mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($histories as $history) : ?>
                                        <?php $no++; ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $history['name']; ?></td>
                                            <td><?= $history['payment_method']; ?></td>
                                            <td><button disabled="disabled" class="btn btn-danger" style="font-size: 13px;"><?= $history['status']; ?></button></td>
                                            <td>Rp. <?= number_format($history['total_price'], 2, ',', '.'); ?></td>
                                            <td><?= $history['createAt']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="home.php" class="btn btn-danger">Back</a>
                        </div>
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