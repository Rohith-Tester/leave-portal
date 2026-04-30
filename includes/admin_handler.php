<?php
session_start();
include 'db.php';

$msg = "";

if(isset($_GET['approve'])){

$id = $_GET['approve'];

$q = mysqli_query($conn,"SELECT * FROM leave_requests WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

$user = $data['username'];
$type = $data['leave_type'];
$from = $data['from_date'];
$to   = $data['to_date'];

$days = (strtotime($to) - strtotime($from)) / 86400 + 1;

mysqli_query($conn,"UPDATE leave_requests SET status='Approved' WHERE id='$id'");

if($type == 'Casual Leave'){
mysqli_query($conn,"UPDATE users SET casual_leave = casual_leave - $days WHERE username='$user'");
}

if($type == 'Sick Leave'){
mysqli_query($conn,"UPDATE users SET sick_leave = sick_leave - $days WHERE username='$user'");
}

if($type == 'Earned Leave'){
mysqli_query($conn,"UPDATE users SET earned_leave = earned_leave - $days WHERE username='$user'");
}

$msg="approved";
}

if(isset($_GET['reject'])){

$id = intval($_GET['reject']);

mysqli_query($conn,"UPDATE leave_requests SET status='Rejected' WHERE id='$id'");

$msg="rejected";
}

$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests"))['total'];
$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests WHERE status='Pending'"))['total'];
$approved = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests WHERE status='Approved'"))['total'];
$rejected = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests WHERE status='Rejected'"))['total'];

$res = mysqli_query($conn,"SELECT * FROM leave_requests ORDER BY id DESC");
?>