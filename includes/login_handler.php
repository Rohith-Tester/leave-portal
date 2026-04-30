<?php
session_start();
include 'db.php';

$msg = "";

if(isset($_POST['login'])){

    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$u' AND password='$p'");

    if(mysqli_num_rows($q) > 0){

        $row = mysqli_fetch_assoc($q);

        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if($row['role']=="admin"){
            header("Location: admin.php");
        }else{
            header("Location: dashboard.php");
        }
        exit();

    }else{
        $msg = "Invalid Username or Password";
    }
}
?>