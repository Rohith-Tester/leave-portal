<?php
session_start();
include 'db.php';

/* 🔥 PAGINATION SETTINGS */
$limit = 9;

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

mysqli_query($conn,"
UPDATE leave_requests 
SET status='Approved', notification_seen=0 
WHERE id='$id'
");

if($type == 'Casual Leave'){
mysqli_query($conn,"UPDATE users SET casual_leave = casual_leave - $days WHERE username='$user'");
}

if($type == 'Sick Leave'){
mysqli_query($conn,"UPDATE users SET sick_leave = sick_leave - $days WHERE username='$user'");
}

if($type == 'Earned Leave'){
mysqli_query($conn,"UPDATE users SET earned_leave = earned_leave - $days WHERE username='$user'");
}

$_SESSION['msg'] = "Leave Approved Successfully";
header("Location: admin.php");
exit();

}
}

/* 🔥 REJECT */
if(isset($_GET['reject'])){

$id = intval($_GET['reject']);

mysqli_query($conn,"
UPDATE leave_requests 
SET status='Rejected', notification_seen=0 
WHERE id='$id'
");

$_SESSION['msg'] = "Leave Rejected Successfully";
header("Location: admin.php");
exit();
}

/* 🔥 COUNTS (FIXED WITH JOIN) */

$total = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total
    FROM leave_requests lr
    JOIN users u ON lr.username = u.username
    ")
)['total'];

$pending = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM leave_requests lr
    JOIN users u ON lr.username = u.username
    WHERE lr.status='Pending'
    ")
)['total'];

$approved = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM leave_requests lr
    JOIN users u ON lr.username = u.username
    WHERE lr.status='Approved'
    ")
)['total'];

$rejected = mysqli_fetch_assoc(
    mysqli_query($conn,"
    SELECT COUNT(*) total 
    FROM leave_requests lr
    JOIN users u ON lr.username = u.username
    WHERE lr.status='Rejected'
    ")
)['total'];

/* 🔥 TOTAL PAGES */
$totalPages = ceil($total / $limit);

/* 🔥 MAIN DATA QUERY (FIXED) */

$res = mysqli_query($conn,"
SELECT lr.*
FROM leave_requests lr
JOIN users u ON lr.username = u.username
ORDER BY lr.id DESC
LIMIT $start, $limit
");

/* 🔥 AUTO FIX EMPTY PAGE */
if(mysqli_num_rows($res) == 0 && $page > 1){
    header("Location: admin.php?page=1");
    exit();
}

$employees = mysqli_query($conn,
"SELECT * FROM users");
?>