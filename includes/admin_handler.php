<?php
session_start();
include 'db.php';

/* 🔥 PAGINATION SETTINGS */
$limit = 9; // rows per page

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;

$start = ($page - 1) * $limit;

$msg = "";

/* 🔥 APPROVE */
if(isset($_GET['approve'])){

$id = intval($_GET['approve']);

$q = mysqli_query($conn,"SELECT * FROM leave_requests WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

if($data){

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
}

/* 🔥 REJECT */
if(isset($_GET['reject'])){

$id = intval($_GET['reject']);

mysqli_query($conn,"UPDATE leave_requests SET status='Rejected' WHERE id='$id'");

$msg="rejected";
}

/* 🔥 COUNTS */
$total = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests")
)['total'];

$pending = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests WHERE status='Pending'")
)['total'];

$approved = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests WHERE status='Approved'")
)['total'];

$rejected = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM leave_requests WHERE status='Rejected'")
)['total'];

/* 🔥 TOTAL PAGES */
$totalPages = ceil($total / $limit);

/* 🔥 MAIN DATA QUERY WITH LIMIT */
$res = mysqli_query($conn,"
SELECT * FROM leave_requests
ORDER BY id DESC
LIMIT $start, $limit
");
?>