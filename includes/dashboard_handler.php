<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

$user = $_SESSION['user'];

$q = mysqli_query($conn,"
SELECT casual_leave,sick_leave,earned_leave
FROM users
WHERE username='$user'
");

$data = mysqli_fetch_assoc($q);

$casual = $data['casual_leave'];
$sick   = $data['sick_leave'];
$earned = $data['earned_leave'];

$totalLeaves = $casual + $sick + $earned;

$pq = mysqli_query($conn,"
SELECT COUNT(*) total
FROM leave_requests
WHERE username='$user'
AND status='Pending'
");

$pending = mysqli_fetch_assoc($pq)['total'];

$aq = mysqli_query($conn,"
SELECT COUNT(*) total
FROM leave_requests
WHERE username='$user'
AND status='Approved'
");

$approved = mysqli_fetch_assoc($aq)['total'];

$rq = mysqli_query($conn,"
SELECT COUNT(*) total
FROM leave_requests
WHERE username='$user'
AND status='Rejected'
");

$rejected = mysqli_fetch_assoc($rq)['total'];

$presentDays = 30 - $approved;

if($presentDays < 0){
$presentDays = 0;
}

$attendance = round(($presentDays / 30) * 100) . "%";
?>