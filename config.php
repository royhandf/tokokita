<?php 
    require 'connection.php';

    function data($sql) {
        global $con;
        $result = mysqli_query($con, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    function account($users) {
        global $con;

        $name = $users['fullname'];
        $email = $users['email'];
        $password = mysqli_real_escape_string($con, $users['password']);
        $confirm_password = mysqli_real_escape_string($con, $users['confirm_password']);

        // cek email sudah ada atau tidak
        $checkEmail = mysqli_query($con, "SELECT email FROM customer WHERE email = '$email'");
        if (mysqli_fetch_assoc($checkEmail)) {
            echo "<script>
                    alert('Email terdaftar!');
                </script>";
            return false;
        }

        // cek konfirmasi password
        if($password !== $confirm_password) {
            echo "<script>
                    alert('Password tidak sesuai!');
                </script>";
            return false;
        }

        // enkripsi password user
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        // input ke database
        mysqli_query($con, "INSERT INTO customer VALUES ('', '$name', '$password', '$email', '', '')");

        return mysqli_affected_rows($con);
    }
?>