<?php
    session_start();
    
    require '../../../control.php';

    if(!isset($_SESSION["login"])) {
        header("Location: /index.php");
        exit;
    }
    
    $id = $_GET["id"];
    
    if (deleteCategory($id) > 0) {
        echo "
            <script> 
                alert('Data berhasil dihapus!')
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script> 
                alert('Data gagal dihapus!')
                document.location.href = 'index.php';
            </script>
        ";
    }
?>