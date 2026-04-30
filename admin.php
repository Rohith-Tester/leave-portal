<?php include 'includes/admin_handler.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<body>

<div class="mini-table-box">

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

<div class="table-top-bar">

<div class="table-top-info">
Showing 1 to <?php echo $total; ?> of <?php echo $total; ?> entries
</div>

<div class="top-pagination">
<a href="#">Previous</a>
<a href="#" class="active-page">1</a>
<a href="#">Next</a>
</div>

</div>

<table class="small-table">

<tr>
<th>User</th>
<th>Type</th>
<th>From</th>
<th>To</th>
<th>Status</th>
<th>Action</th>
</tr>

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

<tfoot>
<tr class="search-footer">
<td><input type="text" placeholder="🔍 User"></td>
<td><input type="text" placeholder="🔍 Type"></td>
<td><input type="text" placeholder="🔍 From"></td>
<td><input type="text" placeholder="🔍 To"></td>
<td><input type="text" placeholder="🔍 Status"></td>
<td></td>
</tr>
</tfoot>

</table>

</div>

<?php include 'includes/admin_footer.php'; ?>