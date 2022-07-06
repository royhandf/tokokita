<?php 
    session_start();
    
    require '../connection.php';
    
    $id = $_GET['id'];

    $deleteCart = mysqli_query($con, "DELETE FROM cart WHERE id = '$id'");

    if($deleteCart) {
        header('Location: cart.php');
    }
?>