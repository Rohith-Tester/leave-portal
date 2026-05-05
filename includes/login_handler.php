<?php
session_start();
include 'db.php';

$msg = "";

if(isset($_POST['login'])){

    $u = $_POST['username'];
    $p = $_POST['password'];

    // 🔥 ONLY CHECK USERNAME
    $query = "SELECT * FROM users WHERE username='$u'";

    $q = mysqli_query($conn,$query);
    if(mysqli_num_rows($q) > 0){

        $row = mysqli_fetch_assoc($q);
        $db_pass = $row['password'];

        // ✅ HANDLE HASH + OLD PLAIN PASSWORD
            
       if(password_verify( $p , $db_pass ) ){

            $_SESSION['user'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            if($row['role']=="admin"){
                header("Location: admin.php");
            }else{
                header("Location: dashboard.php");
            }
            exit();

        }else{
            $msg = "Invalid Username or Password inside ";

        }

    }else{
        $msg = "Invalid Username or Password";
    }
}
?>