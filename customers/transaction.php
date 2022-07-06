<?php 
    session_start();

    require '../control.php';

    $customer_id = $_SESSION['id'];
    $total_price = 0;

    $receivers = query("SELECT * FROM customer WHERE id = '$customer_id'");
    $transactions = query("SELECT x.id, x.product_id, y.name, x.amount, x.total_price
                            FROM cart x 
                            INNER JOIN product y ON x.product_id = y.id
                            ");
    $payments = query("SELECT * FROM payment");
    
    if (isset($_POST['checkout'])) {
        foreach($payments as $payment) {
            if ($payment['payment_method'] == $_POST['payment']) {
                if(checkout($_POST) == true) {
                    $number = $payment['account_number'];
                    echo "
                        <script> 
                            alert('Terima Kasih sudah Berbelanja, Silahkan Tranfer ke No. Rek $number. Barang anda akan segera kami kirim setelah pembayaran dilakukan. Semoga anda nyaman dengan layanan kami!!')
                            document.location.href = 'home.php';
                        </script>
                    ";
                }
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
    <title>Tokokita</title>
    <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-white navbar-light shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand " href="#">Tokokita</a>
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
                            <ul class="dropdown-menu">
                                <?php foreach($categories as $category) : ?>
                                    <li><a class="dropdown-item" href="categories.php?id=<?= $category['id']; ?>"><?= $category['category_name']; ?></a></li>
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
                                <li><a href="dashboard.php" class="dropdown-item">Dashboard</a></li>
                                <li><a href="history.php" class="dropdown-item">History</a></li>
                                <li><a href="/logout.php" class="dropdown-item">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>
    <main class="py-5 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="shadow p-5 rounded bg-white">
                        <h2><strong>Checkout</strong></h2>
                        <hr>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-6">
                                    <div class="shadow card p-3">
                                        <?php foreach($receivers as $receiver) : ?>
                                            <h4><strong>Your Identity</strong></h4>
                                            <hr>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="<?= $receiver['name']; ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="<?= $receiver['email']; ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="number" name="phone_number" id="phone_number" class="form-control " value="<?= $receiver['phone_number']; ?>" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                                            </div>
                                        <?php break; endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="shadow card p-3 mb-3">
                                                <h4><strong>Payment Method</strong></h4>
                                                <div class="row">
                                                    <?php foreach($payments as $payment) : ?>
                                                        <div class="form-check m-3 col-3 payment-method">
                                                            <input type="hidden" name="payment_id" value="<?= $payment['id']; ?>">
                                                            <input class="form-check-input" type="radio" name="payment" value="<?= $payment['payment_method']; ?>" checked>
                                                            <label class="form-check-label" for="payment"><?= $payment['payment_method']; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="shadow card p-3">
                                                <h4>Your Order</h4>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Produk</th>
                                                            <th class="text-right">Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($transactions as $transaction) : ?>
                                                            <input type="hidden" name="transaction_id" value="<?= $transaction['id']; ?>">
                                                            <input type="hidden" name="product_id" value="<?= $transaction['product_id']; ?>">
                                                            <input type="hidden" name="amount" value="<?= $transaction['amount']; ?>">
                                                            <?php $total_price += $transaction['total_price']; ?>
                                                            <tr>
                                                                <td><?= $transaction['name']; ?> (<?= $transaction['amount']; ?>)</td>
                                                                <td>Rp. <?= number_format($transaction['total_price'], 2, ',', '.'); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                            <tr>
                                                                <td><h5>Total Price</h5></td>
                                                                <td><h5 class="text-danger ">Rp. <?= number_format($total_price, 2, ',', '.'); ?></h5></td>
                                                                <input type="hidden" name="total_price" value="<?= $total_price; ?>">
                                                            </tr>
                                                    </tbody>
                                                </table>
                                                <button type="submit" name="checkout" class="btn btn-dark d-block">Checkout</button>
                                            </div>
                                        </div>
                                    </div>
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