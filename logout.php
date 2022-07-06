<?php 
    session_start();

    // biar yakin session sudah tidak ada menggunakan unset dan destroy
    session_unset();
    session_destroy();

    header("location: /index.php");
    exit;
?>