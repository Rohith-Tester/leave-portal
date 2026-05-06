<?php
session_start();
include 'db.php';

$msg = "";

if(isset($_POST['login'])){

    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    /* 🔥 DEFAULT USER */
    $login_role = "user";

    /* 🔥 IF ROLE BUTTON SELECTED */
    if(isset($_POST['login_role'])){
        $login_role = $_POST['login_role'];
    }

    /* 🔥 CHECK USERNAME + ROLE */
    $query = "SELECT * FROM users
    WHERE username='$u'
    AND role='$login_role'";

    $q = mysqli_query($conn,$query);

    if(mysqli_num_rows($q) > 0){

        $row = mysqli_fetch_assoc($q);

        $db_pass = $row['password'];

        /* ✅ PASSWORD VERIFY */
        if(password_verify($p , $db_pass)){

            $_SESSION['user'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            /* 🔥 ADMIN LOGIN */
            if($row['role'] == "admin"){

                header("Location: admin.php");
                exit();

            }

            /* 🔥 USER LOGIN */
            else{

                header("Location: dashboard.php");
                exit();

            }

        }else{

            $msg = "Invalid Username or Password";

        }

    }else{

        if($login_role == "admin"){

            $msg = "Admin account not found";

        }else{

            $msg = "User account not found";

        }

    }

}
?>