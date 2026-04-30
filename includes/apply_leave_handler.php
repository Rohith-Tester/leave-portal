<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

$msg = "";

$user = $_SESSION['user'];

$res = mysqli_query($conn,"
SELECT casual_leave,sick_leave,earned_leave
FROM users
WHERE username='$user'
");

if($res && mysqli_num_rows($res)>0){

$data = mysqli_fetch_assoc($res);

$casual = $data['casual_leave'];
$sick   = $data['sick_leave'];
$earned = $data['earned_leave'];

}else{

$casual = 5;
$sick   = 3;
$earned = 7;

}

$total = $casual + $sick + $earned;

if(isset($_POST['submit'])){

$u  = $_SESSION['user'];
$t  = $_POST['type'];
$f  = $_POST['from'];
$to = $_POST['to'];
$r  = $_POST['reason'];

mysqli_query($conn,"
INSERT INTO leave_requests
(username,leave_type,from_date,to_date,reason)
VALUES
('$u','$t','$f','$to','$r')
");

$msg = "Leave Applied Successfully";

}
?>