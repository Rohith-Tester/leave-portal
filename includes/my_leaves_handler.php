<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}

$user = $_SESSION['user'];

$limit = 13;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1){
$page = 1;
}

$start = ($page - 1) * $limit;

$countRes = mysqli_query($conn,"
SELECT * FROM leave_requests
WHERE username='$user'
");

$total = mysqli_num_rows($countRes);

$totalPages = ceil($total / $limit);

if($totalPages < 1){
$totalPages = 1;
}

$res = mysqli_query($conn,"
SELECT * FROM leave_requests
WHERE username='$user'
ORDER BY id DESC
LIMIT $start,$limit
");
?>