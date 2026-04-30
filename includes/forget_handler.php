<?php
include 'db.php';

$msg = "";

if(isset($_POST['update'])){

$user    = $_POST['username'];
$verify  = $_POST['verify'];
$newpass = $_POST['newpass'];
$cpass   = $_POST['confirmpass'];

if($newpass != $cpass){

$msg = "Password does not match";

}else{

$q = mysqli_query($conn,"
SELECT * FROM users
WHERE username='$user'
AND (email='$verify' OR mobile='$verify')
");

if(mysqli_num_rows($q) > 0){

mysqli_query($conn,"
UPDATE users
SET password='$newpass'
WHERE username='$user'
");

header("Location: login.php");
exit();

}else{
$msg = "Invalid Username / Email / Mobile";
}

}

}
?>