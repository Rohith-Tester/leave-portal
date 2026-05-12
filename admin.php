<?php include 'includes/admin_handler.php'; ?>
<?php include 'includes/admin_header.php'; ?>

<body>

<div class="mini-table-box">

<!-- ===== TOP BAR ===== -->
<div class="admin-topbar">

<!-- LEFT SIDE -->
<div class="top-left-btn">

<a href="employee_details.php"
class="logout-btn">
Employee
</a>

</div>

<!-- CENTER -->
<div class="admin-title">
Admin Panel
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

<!-- ===== TABLE TOP ===== -->
<div class="table-top-bar">

<div class="showing-info">

Showing <?php echo $total==0 ? 0 : $start+1; ?>
to <?php echo min($start+$limit,$total); ?>
of <?php echo $total; ?> entries

</div>

<div class="pagination-box">

<?php if($page > 1){ ?>

<a href="?page=<?php echo $page-1; ?>">
Previous
</a>

<?php } else { ?>

<span class="disabled-btn">
Previous
</span>

<?php } ?>

<?php for($i=1; $i<=$totalPages; $i++){ ?>

<a href="?page=<?php echo $i; ?>"
class="<?php if($page==$i) echo 'active-page'; ?>">

<?php echo $i; ?>

</a>

<?php } ?>

<?php if($page < $totalPages){ ?>

<a href="?page=<?php echo $page+1; ?>">
Next
</a>

<?php } else { ?>

<span class="disabled-btn">
Next
</span>

<?php } ?>

</div>

</div>

<!-- ===== LEAVE REQUEST TABLE ===== -->
<div class="table-wrapper">

<table class="small-table"
id="leaveTable">

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

<tr class="leave-row"

data-user="<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>"

data-type="<?php echo htmlspecialchars($row['leave_type'], ENT_QUOTES); ?>"

data-from="<?php echo $row['from_date']; ?>"

data-to="<?php echo $row['to_date']; ?>"

data-reason="<?php echo htmlspecialchars($row['reason'], ENT_QUOTES); ?>"

data-status="<?php echo $row['status']; ?>"

style="cursor:pointer;">

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['leave_type']; ?></td>

<td><?php echo $row['from_date']; ?></td>

<td><?php echo $row['to_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<?php if($row['status']=="Pending"){ ?>

<a href="admin.php?approve=<?php echo $row['id']; ?>"
class="approve-btn">

Approve

</a>

<a href="admin.php?reject=<?php echo $row['id']; ?>"
class="reject-btn">

Reject

</a>

<?php } elseif($row['status']=="Approved"){ ?>

<button class="approved-done">
✅
</button>

<?php } else { ?>

<button class="rejected-done">
❌
</button>

<?php } ?>

</td>

</tr>

<?php } ?>

<tr id="noSearchData"
class="filtered-hide">

<td colspan="6"
class="no-data-cell">

No matching records found

</td>

</tr>

<?php } else { ?>

<tr>

<td colspan="6"
class="no-data-cell">

No leave records found

</td>

</tr>

<?php } ?>

</tbody>

</table>

<!-- ===== SEARCH FOOTER ===== -->
<div class="search-footer">

<div class="search-row">

<div class="search-col">

<input type="text"
id="searchUser"
placeholder="🔍 User"
onkeyup="filterTable()">

</div>

<div class="search-col">

<input type="text"
id="searchType"
placeholder="🔍 Type"
onkeyup="filterTable()">

</div>

<div class="search-col">

<input type="text"
id="searchFrom"
placeholder="🔍 From"
onkeyup="filterTable()">

</div>

<div class="search-col">

<input type="text"
id="searchTo"
placeholder="🔍 To"
onkeyup="filterTable()">

</div>

<div class="search-col">

<input type="text"
id="searchStatus"
placeholder="🔍 Status"
onkeyup="filterTable()">

</div>

<div class="search-action-space"></div>

</div>

</div>

</div>

</div>

<!-- ===== ROW DETAILS POPUP ===== -->

<script>

document.querySelectorAll(".leave-row").forEach(row => {

row.addEventListener("click", function(e){

if(e.target.closest("a,button")) return;

let user = this.dataset.user;
let type = this.dataset.type;
let from = this.dataset.from;
let to = this.dataset.to;
let reason = this.dataset.reason;
let status = this.dataset.status;

let d1 = new Date(from);
let d2 = new Date(to);

let days =
(d2 - d1)/(1000*60*60*24) + 1;

Swal.fire({

title: "Leave Details",

html: `
<b>User:</b> ${user}<br>
<b>Type:</b> ${type}<br>
<b>From:</b> ${from}<br>
<b>To:</b> ${to}<br>
<b>Days:</b> ${days}<br>
<b>Status:</b> ${status}<br><br>
<b>Reason:</b><br>${reason}
`

});

});

});

</script>

<?php include 'includes/admin_footer.php'; ?>