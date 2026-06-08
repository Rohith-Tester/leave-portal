<?php
session_start();

include 'db.php';


//ONLY ADMIN ACCESS
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){

    header("Location: /leaveapp/login.php");
   exit;
}


// CREATE ADMIN
if(isset($_POST['create_admin'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    // CHECK EMAIL
    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){

        $message = "Email already exists";

    } else {

$sql = "INSERT INTO users(fullname,username,password,role,email)
VALUES('$name','$name','$password','admin','$email')";

if(mysqli_query($conn, $sql) or die(mysqli_error($conn))){

    $message = "Admin Created Successfully";

} else {

    $message = "Failed to Create Admin";
}
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Admin</title>

    <link rel="stylesheet" href="css/add_admin.css">

</head>
<body>

<div class="container">

    <h2>Create Admin</h2>

    <?php
    if(isset($message)){
        echo "<div class='message'>$message</div>";
    }
    ?>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Admin Name"
               required>

        <input type="email"
               name="email"
               placeholder="Admin Email"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button type="submit" name="create_admin">
            Create Admin
        </button>

    </form>

</div>

</body>
</html>