<?php

include 'db.php';
include 'includes/admin_header.php';

/* ===== PAGINATION ===== */

$limit = 10;

$page = isset($_GET['page'])
? (int)$_GET['page'] : 1;

if($page < 1){
$page = 1;
}

$start = ($page - 1) * $limit;

/* ===== TOTAL EMPLOYEES ===== */

$totalEmployees = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) total FROM users")
)['total'];

/* ===== TOTAL PAGES ===== */

$totalPages = ceil($totalEmployees / $limit);

/* ===== EMPLOYEE DATA ===== */

$employees = mysqli_query($conn,
"SELECT * FROM users
ORDER BY id DESC
LIMIT $start,$limit");

?>

<body>

<div class="mini-table-box">

<!-- ===== TOP BAR ===== -->

<div class="admin-topbar">

<!-- LEFT SIDE -->

<div class="top-left-btn">

<a href="admin.php"
class="logout-btn">
Leave Requests
</a>

</div>

<!-- CENTER -->

<div class="admin-title">
Employee Details
</div>

<!-- RIGHT SIDE -->

<div class="admin-right">

<div class="admin-profile">

<div class="profile-icon">A</div>

<div class="profile-text">
<h4>admin</h4>
<p>Administrator</p>
</div>

</div>

<a href="logout.php"
class="logout-btn">
Logout
</a>

</div>

</div>

<!-- ===== STATS ===== -->

<div class="admin-stats">

<div class="admin-card total">
<h3><?php echo $totalEmployees; ?></h3>
<p>Total Employees</p>
</div>

<div class="admin-card approved">
<h3><?php echo $totalEmployees; ?></h3>
<p>Active Employees</p>
</div>

<div class="admin-card pending">
<h3>0</h3>
<p>On Leave</p>
</div>

<div class="admin-card rejected">
<h3>0</h3>
<p>Inactive</p>
</div>

</div>

<!-- ===== TABLE TOP ===== -->

<div class="table-top-bar">

<div class="showing-info">

Showing
<?php echo $start + 1; ?>

to

<?php
echo min(
$start + $limit,
$totalEmployees
);
?>

of
<?php echo $totalEmployees; ?>
entries

</div>

<div class="pagination-box">

<?php if($page > 1){ ?>

<a href="?page=<?php echo $page - 1; ?>">
Previous
</a>

<?php } else { ?>

<span class="disabled-btn">
Previous
</span>

<?php } ?>

<?php for($i=1; $i<=$totalPages; $i++){ ?>

<a href="?page=<?php echo $i; ?>"
class="<?php echo ($page == $i)
? 'active-page' : ''; ?>">

<?php echo $i; ?>

</a>

<?php } ?>

<?php if($page < $totalPages){ ?>

<a href="?page=<?php echo $page + 1; ?>">
Next
</a>

<?php } else { ?>

<span class="disabled-btn">
Next
</span>

<?php } ?>

</div>

</div>

<!-- ===== EMPLOYEE TABLE ===== -->

<div class="table-wrapper">

<table class="small-table">

<thead>

<tr>

<th>ID</th>
<th>Full Name</th>
<th>Username</th>
<th>Email</th>
<th>Mobile</th>
<th>Department</th>
<th>Designation</th>
<th>Role</th>

</tr>

</thead>

<tbody>

<?php if(mysqli_num_rows($employees) > 0){ ?>

<?php while($emp =
mysqli_fetch_assoc($employees)){ ?>

<tr>

<td><?php echo $emp['id']; ?></td>

<td><?php echo $emp['fullname']; ?></td>

<td><?php echo $emp['username']; ?></td>

<td><?php echo $emp['email']; ?></td>

<td><?php echo $emp['mobile']; ?></td>

<td><?php echo $emp['department']; ?></td>

<td><?php echo $emp['designation']; ?></td>

<td><?php echo $emp['role']; ?></td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>

<td colspan="8"
class="no-data-cell">

No Employee Data Found

</td>

</tr>

<?php } ?>

</tbody>

</table>

<!-- ===== SEARCH FOOTER ===== -->

<div class="employee-search-footer">

<div class="employee-search-row">

<div class="employee-search-col">
<input type="text"
id="searchId"
placeholder="🔍 ID"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchFullname"
placeholder="🔍 Full Name"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchUsername"
placeholder="🔍 Username"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchEmail"
placeholder="🔍 Email"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchMobile"
placeholder="🔍 Mobile"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchDepartment"
placeholder="🔍 Department"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchDesignation"
placeholder="🔍 Designation"
onkeyup="filterEmployeeTable()">
</div>

<div class="employee-search-col">
<input type="text"
id="searchRole"
placeholder="🔍 Role"
onkeyup="filterEmployeeTable()">
</div>

</div>

</div>

</div>

</div>

<script src="js/employee-details.js"></script>

<?php include 'includes/admin_footer.php'; ?>