<?php include 'includes/admin_handler.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<body>

<div class="mini-table-box">

<!-- ===== TOP BAR ===== -->
<div class="admin-topbar">

<div></div>

<div class="admin-title">Admin Panel</div>

<div class="admin-right">

<div class="admin-profile">
<div class="profile-icon">A</div>

<div class="profile-text">
<h4>admin</h4>
<p>Administrator</p>
</div>
</div>

<a href="logout.php" class="logout-btn">Logout</a>

</div>
</div>

<!-- ===== STATS ===== -->
<div class="admin-stats">

<div class="admin-card total">
<h3><?php echo $total; ?></h3>
<p>Total</p>
</div>

<div class="admin-card pending">
<h3><?php echo $pending; ?></h3>
<p>Pending</p>
</div>

<div class="admin-card approved">
<h3><?php echo $approved; ?></h3>
<p>Approved</p>
</div>

<div class="admin-card rejected">
<h3><?php echo $rejected; ?></h3>
<p>Rejected</p>
</div>

</div>

<!-- ===== TOP BAR (SHOWING + PAGINATION) ===== -->
<div class="table-top-bar">

    <div class="showing-info">
        Showing <?php echo $total==0 ? 0 : $start+1; ?>
        to <?php echo min($start+$limit,$total); ?>
        of <?php echo $total; ?> entries
    </div>


<div class="pagination-box">

<?php if($page > 1){ ?>
<a href="?page=<?php echo $page-1; ?>">Previous</a>
<?php } else { ?>
<span class="disabled-btn">Previous</span>
<?php } ?>

<?php for($i=1; $i<=$totalPages; $i++){ ?>
<a href="?page=<?php echo $i; ?>"
class="<?php if($page==$i) echo 'active-page'; ?>">
<?php echo $i; ?>
</a>
<?php } ?>

<?php if($page < $totalPages){ ?>
<a href="?page=<?php echo $page+1; ?>">Next</a>
<?php } else { ?>
<span class="disabled-btn">Next</span>
<?php } ?>

</div>

</div>

<!-- ===== TABLE WRAPPER (IMPORTANT) ===== -->
<div class="table-wrapper">

<table class="small-table">

<thead>
<tr>
<th>User</th>
<th>Type</th>
<th>From</th>
<th>To</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($res) > 0){ ?>

<?php while($row=mysqli_fetch_assoc($res)){ ?>

<tr>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['leave_type']; ?></td>
<td><?php echo $row['from_date']; ?></td>
<td><?php echo $row['to_date']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>
<?php if($row['status']=="Pending"){ ?>
<a href="admin.php?approve=<?php echo $row['id']; ?>" class="approve-btn">Approve</a>
<a href="admin.php?reject=<?php echo $row['id']; ?>" class="reject-btn">Reject</a>
<?php } elseif($row['status']=="Approved"){ ?>
<button class="approved-done">✅</button>
<?php } else { ?>
<button class="rejected-done">❌</button>
<?php } ?>
</td>
</tr>

<?php } ?>

<!-- 🔥 FILL EMPTY SPACE -->
<tr id="tableFiller">
<td colspan="6"></td>
</tr>

<?php } else { ?>

<tr>
<td colspan="6" class="no-data-cell">
No leave records found
</td>
</tr>

<?php } ?>

</tbody>

</table>

<div class="search-footer">
    <div class="search-row">
        <input type="text" id="searchUser" placeholder="🔍 User" onkeyup="filterTable()">
        <input type="text" id="searchType" placeholder="🔍 Type" onkeyup="filterTable()">
        <input type="text" id="searchFrom" placeholder="🔍 From" onkeyup="filterTable()">
        <input type="text" id="searchTo" placeholder="🔍 To" onkeyup="filterTable()">
        <input type="text" id="searchStatus" placeholder="🔍 Status" onkeyup="filterTable()">
    </div>
</div>

</div> <!-- END table-wrapper -->

</div> <!-- END mini-table-box -->

<?php include 'includes/admin_footer.php'; ?>