<?php 
    session_start();
    require '../connection.php';

    $product_id = $_GET['id'];
    $amount = $_POST['qyt'];

    $product = mysqli_query($con, "SELECT id, price FROM product WHERE id = '$product_id'");
    $data = mysqli_fetch_array($product);

    $price = $data['price'];
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d H:i:s');

    $total_price = $amount * $price;

    foreach($product as $result) {
        if ($result['id'] == $product_id) {
        }
    }
    
    $addCart = mysqli_query($con, "INSERT INTO cart VALUES ('', '$product_id', '$amount', '$total_price', '$date')");

    if($addCart) {
        header('Location: cart.php');
    }
?>