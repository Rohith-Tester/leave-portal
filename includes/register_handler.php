<?php
session_start();
include 'db.php';

$msg = "";

if(isset($_POST['register'])){

$captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : "";

if($captcha == ""){

$msg = "Please verify captcha";

}else{

$secret = "6LcFc84sAAAAAL5LOyVAJWTkuH_SNL1la6Kji1v6";

$verify = file_get_contents(
"https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha"
);

$response = json_decode($verify, true);

if($response["success"]){

$name     = trim($_POST['fullname']);
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$mobile   = trim($_POST['mobile']);
$password = trim($_POST['password']);
$cpass    = trim($_POST['confirm_password']);
$role     = trim($_POST['role']);

if($password != $cpass){

$msg = "Password does not match";

}else{

$check = mysqli_query($conn,"SELECT id FROM users WHERE username='$username'");

if(mysqli_num_rows($check) > 0){

$msg = "Username already exists";

}else{

$insert = mysqli_query($conn,"
INSERT INTO users
(fullname,username,password,role,casual_leave,sick_leave,earned_leave,email,mobile)
VALUES
('$name','$username','$password','$role','0','0','0','$email','$mobile')
");

if($insert){
header("Location: login.php");
exit();
}else{
$msg = mysqli_error($conn);
}

}

}

}else{
$msg = "Captcha verification failed";
}

}

}
?>