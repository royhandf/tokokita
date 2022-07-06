<?php 
    session_start();

    require '../../../connection.php';
    require '../../../control.php';

    if(!isset($_SESSION["login"])) {
        header("Location: /index.php");
        exit;
    }

    $id = $_GET['id'];

    $products = query(
                    "SELECT x.*, y.* FROM product x 
                    INNER JOIN product_galleries y ON x.id = y.product_id
                    WHERE y.product_id = $id
                ");
    // var_dump($products);

    if (isset($_POST['insert'])) {
        $limit = 10 * 1024 * 1024; // 10mb
        $validasi =  ['png','jpg','jpeg'];
        $jumlahFile = count($_FILES['gambar']['name']);
        
        for($x = 0; $x < $jumlahFile; $x++) {
            $namafile = $_FILES['gambar']['name'][$x];
            $tmp = $_FILES['gambar']['tmp_name'][$x];
            $tipe_file = pathinfo($namafile, PATHINFO_EXTENSION);
            $ukuran = $_FILES['gambar']['size'][$x];	

            if ($ukuran > $limit) {
                echo "
                        <script> 
                            alert('Ukuran file terlalu besar!')
                            document.location.href = 'image.php';
                        </script>
                    ";		
            } else {
                if (!in_array($tipe_file, $validasi)) {
                    echo "
                        <script>
                            alert('Yang diupload bukan gambar!')
                            document.location.href = 'image.php';
                        </script>;
                    ";			
                } else {
                    $namaFileBaru = uniqid();
                    $namaFileBaru .= '.';
                    $namaFileBaru .= $tipe_file;		
                    move_uploaded_file($tmp, 'C:/xampp/htdocs/prak-web/tokokita/assets/' .$namaFileBaru);
                    mysqli_query($con,"INSERT INTO product_galleries VALUES ('', '$id', '$namaFileBaru')");
                    echo "
                            <script> 
                                alert('Gambar berhasil diubah!')
                                document.location.href = 'index.php';
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
    <title>Dashboard</title>
    <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
</head>
<body>
    <nav class="navbar navbar-dark bg-dark sticky-top p-3 shadow-sm">
        <div class="d-flex col-12 col-md-3 mb-2 mb-lg-0 justify-content-between">
            <a href="/dashboard" class="navbar-brand ps-md-4">Tokokita</a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Navbar side -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light shadow collapse">
                <div class="pt-3 position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="../dashboard.php" class="nav-link text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../order/index.php" class="nav-link text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file" aria-hidden="true"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../product/index.php" class="nav-link text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../customer/index.php" class="nav-link text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../category/index.php" class="nav-link text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../report/index.php" class="nav-link text-black ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                                Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" target="_blank" href="../home.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                Landing Page
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link text-danger"  href="/logout.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>                                
                            Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Content -->
            <main class="col-md-8 ms-sm-auto col-lg-10 px-md-4 py-4">
                <h2>Insert Product Image</h2>
                <hr>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="my-3">
                        <label for="gambar" class="form-label">Product Image</label>
                        <div class="row">
                            <?php foreach($products as $product) : ?>
                                <div class="col-1">
                                    <img src="../../../assets/<?= $product['image']; ?>" alt="<?= $product['image']; ?>" width="80" class="form-label">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <input type="file" name="gambar[]" id="gambar" class="form-control" multiple>
                    </div>
                    <div class="my-4">
                        <a href="index.php" class="btn btn-danger">Back</a>
                        <button type="submit" name="insert" class="btn btn-primary">Insert</button>
                    </div>
                </form>
                <footer class="mt-5">
                    <hr>
                    <div class="container text-center">
                        <p class="text-muted">Copyright © 2022 | All right reserved.</p>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
</body>
</html>