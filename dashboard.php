<?php include 'includes/dashboard_handler.php'; ?>
<?php include 'includes/dashboard_header.php'; ?>

<?php
/** @var mysqli $conn */
$user = $_SESSION['user'];

$totalLeaves = isset($totalLeaves) ? $totalLeaves : 0;
$pending     = isset($pending) ? $pending : 0;
$approved    = isset($approved) ? $approved : 0;
$rejected    = isset($rejected) ? $rejected : 0;
$attendance  = isset($attendance) ? $attendance : '0%';

/* ---------------- SEARCH / FILTER / PAGINATION ---------------- */

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1){ $page = 1; }

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$statusFilter = isset($_GET['filter']) ? trim($_GET['filter']) : '';

$where = " username='$user' ";

if($search != ''){
$where .= " AND leave_type LIKE '%$search%' ";
}

if($statusFilter != ''){
$where .= " AND status='$statusFilter' ";
}

/* total rows */
$countQ = mysqli_query($conn,"
SELECT COUNT(*) total
FROM leave_requests
WHERE $where
");

$totalRows = mysqli_fetch_assoc($countQ)['total'];

$totalPages = ceil($totalRows / $limit);
if($totalPages < 1){ $totalPages = 1; }

if($page > $totalPages){ $page = $totalPages; }

$offset = ($page - 1) * $limit;

/* main rows */
$q = mysqli_query($conn,"
SELECT *
FROM leave_requests
WHERE $where
ORDER BY id DESC
LIMIT $offset,$limit
");

/* download csv */
if(isset($_GET['download']) && $_GET['download']=="csv"){

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=leave_requests.csv");

$output = fopen("php://output","w");

fputcsv($output,["Type","From Date","To Date","Status"]);

$csvQ = mysqli_query($conn,"
SELECT *
FROM leave_requests
WHERE username='$user'
ORDER BY id DESC
");

while($row = mysqli_fetch_assoc($csvQ)){
fputcsv($output,[
$row['leave_type'],
$row['from_date'],
$row['to_date'],
$row['status']
]);
}

fclose($output);
exit();
}
?>

<body>

<div class="topbar">

<div class="nav-left">
<a href="apply_leave.php" class="nav-btn">Apply Leave</a>
<a href="my_leaves.php" class="nav-btn">My Leaves</a>
</div>

<div class="nav-right">

<div class="profile-mini">
<div class="avatar">
<?php echo strtoupper(substr($_SESSION['user'],0,1)); ?>
</div>

<div class="user-meta">
<b><?php echo $_SESSION['user']; ?></b>
</div>

<div class="profile-hover">

<p><strong>Name:</strong> <?php echo $_SESSION['user']; ?></p>
<p><strong>Role:</strong> Employee</p>
<p><strong>Status:</strong> Active</p>
<p><strong>Department:</strong> IT</p>

</div>
</div>

<a href="logout.php" class="logout-btn">Logout</a>

</div>
</div>


<div class="dashboard-wrap">

<h1>Welcome, <?php echo $_SESSION['user']; ?></h1>
<p class="sub-title">Leave Management Dashboard</p>

<div class="stats-grid">

<div class="card blue">
<h2><?php echo $totalLeaves; ?></h2>
<p>Total Leaves</p>
</div>

<div class="card orange">
<h2><?php echo $pending; ?></h2>
<p>Pending</p>
</div>

<div class="card green">
<h2><?php echo $approved; ?></h2>
<p>Approved</p>
</div>

<div class="card red">
<h2><?php echo $rejected; ?></h2>
<p>Rejected</p>
</div>

<div class="card purple">
<h2><?php echo $attendance; ?></h2>
<p>Attendance</p>
</div>

</div>



<div class="bottom-grid">

<!-- LEFT BOX -->

<div class="table-box">

<div class="box-head">
<h3>Your Leave Requests</h3>
<a href="apply_leave.php" class="apply-mini">Apply for a Leave</a>
</div>


<div class="table-tools">

<div class="tools-left">

<form method="GET" style="display:flex; gap:10px; align-items:center;">

<input type="text"
name="search"
value="<?php echo htmlspecialchars($search); ?>"
placeholder="Search..."
class="search-box">

<select name="filter" class="search-box">
<option value="">All</option>
<option value="Pending" <?php if($statusFilter=="Pending") echo "selected"; ?>>Pending</option>
<option value="Approved" <?php if($statusFilter=="Approved") echo "selected"; ?>>Approved</option>
<option value="Rejected" <?php if($statusFilter=="Rejected") echo "selected"; ?>>Rejected</option>
</select>

<button class="nav-btn" style="padding:8px 14px;">Search</button>

</form>

<a href="dashboard.php?download=csv" style="text-decoration:none;">⬇ Download</a>

</div>


<div class="tools-right">

<?php if($page > 1){ ?>
<a class="page-link" href="?page=<?php echo $page-1; ?>&search=<?php echo $search; ?>&filter=<?php echo $statusFilter; ?>">Previous</a>
<?php } else { ?>
<span class="page-link">Previous</span>
<?php } ?>

<?php
for($i=1; $i<=$totalPages; $i++){

if($i <= 5 || $i == $totalPages){

if($i == $page){
?>
<span class="page-box"><?php echo $i; ?></span>
<?php
}else{
?>
<a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&filter=<?php echo $statusFilter; ?>"><?php echo $i; ?></a>
<?php
}

}else if($i == 6){
?>
<span class="page-link">...</span>
<?php
}

}
?>

<?php if($page < $totalPages){ ?>
<a class="page-link" href="?page=<?php echo $page+1; ?>&search=<?php echo $search; ?>&filter=<?php echo $statusFilter; ?>">Next</a>
<?php } else { ?>
<span class="page-link">Next</span>
<?php } ?>

</div>

</div>



<table>

<tr>
<th>Type</th>
<th>From Date</th>
<th>To Date</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($q)){ ?>

<tr>

<td><?php echo $row['leave_type']; ?></td>
<td><?php echo $row['from_date']; ?></td>
<td><?php echo $row['to_date']; ?></td>

<td>

<?php if($row['status']=="Approved"){ ?>
<span class="badge green-badge">Approved</span>

<?php } elseif($row['status']=="Rejected"){ ?>
<span class="badge red-badge">Rejected</span>

<?php } else { ?>
<span class="badge yellow-badge">Pending</span>
<?php } ?>

</td>

</tr>

<?php } ?>

</table>


<div class="table-foot">

<?php
$start = ($totalRows==0) ? 0 : $offset + 1;
$end = $offset + $limit;
if($end > $totalRows){ $end = $totalRows; }
?>

Showing <?php echo $start; ?> to <?php echo $end; ?> of <?php echo $totalRows; ?> entries

</div>

</div>



<!-- RIGHT BOX -->

<div class="status-box">

<h3>Leave Status</h3>

<?php
$q2=mysqli_query($conn,"
SELECT *
FROM leave_requests
WHERE username='$user'
ORDER BY id DESC
LIMIT 3
");

while($row=mysqli_fetch_assoc($q2)){
?>

<div class="status-card">

<div>
<b><?php echo $row['leave_type']; ?></b>
<p><?php echo $row['from_date']; ?> to <?php echo $row['to_date']; ?></p>
</div>

<?php if($row['status']=="Approved"){ ?>
<span class="badge green-badge">Approved</span>

<?php } elseif($row['status']=="Rejected"){ ?>
<span class="badge red-badge">Rejected</span>

<?php } else { ?>
<span class="badge yellow-badge">Pending</span>
<?php } ?>

</div>

<?php } ?>

<a href="dashboard.php" class="refresh-btn">↻ Refresh Data</a>

</div>

</div>

</div>

<?php include 'includes/dashboard_footer.php'; ?>