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

/* 🔥 CALCULATE DAYS */
$d1 = new DateTime($f);
$d2 = new DateTime($to);
$days = $d1->diff($d2)->days + 1;

/* 🔥 FETCH LATEST BALANCE AGAIN (IMPORTANT) */
$q2 = mysqli_query($conn,"
SELECT casual_leave, sick_leave, earned_leave
FROM users
WHERE username='$u'
");
$bal = mysqli_fetch_assoc($q2);

$casual = $bal['casual_leave'];
$sick   = $bal['sick_leave'];
$earned = $bal['earned_leave'];

/* 🔥 VALIDATION */
if($t == "Casual Leave" && $casual < $days){
    $_SESSION['error'] = "No Casual Leave remaining!";
    header("Location: apply_leave.php");
    exit();
}

if($t == "Sick Leave" && $sick < $days){
    $_SESSION['error'] = "No Sick Leave remaining!";
    header("Location: apply_leave.php");
    exit();
}

if($t == "Earned Leave" && $earned < $days){
    $_SESSION['error'] = "No Earned Leave remaining!";
    header("Location: apply_leave.php");
    exit();
}

/* 🔥 INSERT ONLY IF VALID */
mysqli_query($conn,"
INSERT INTO leave_requests
(username,leave_type,from_date,to_date,reason)
VALUES
('$u','$t','$f','$to','$r')
");

/* 🔥 SUCCESS */
$_SESSION['msg'] = "Leave Applied Successfully";
header("Location: apply_leave.php");
exit();

}
?>