<?php include 'includes/my_leaves_handler.php'; ?>
<?php include 'includes/my_leaves_header.php'; ?>

<body>

<div class="top-navbar"></div>

<div class="leave-page full-width-page">

<div class="leave-card full-width-card">

<h1 class="inside-title">My Leaves</h1>

<!-- 🔥 BACK BUTTON (TOP RIGHT ONLY) -->
<div class="top-action-row">
    <a href="dashboard.php" class="top-back-btn small-back-btn">
        ← Back
    </a>
</div>

<!-- 🔥 SHOWING + PAGINATION SAME ROW -->
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

<!-- 🔥 TABLE -->
<div class="table-responsive">

<table class="leave-table">

<tr>
<th>Type</th>
<th>From Date</th>
<th>To Date</th>
<th>Status</th>
</tr>

<?php if(mysqli_num_rows($res) > 0){ ?>

    <?php while($row=mysqli_fetch_assoc($res)){ ?>
    <tr>
        <td><?php echo $row['leave_type']; ?></td>
        <td><?php echo $row['from_date']; ?></td>
        <td><?php echo $row['to_date']; ?></td>
        <td>
            <?php if($row['status']=="Approved"){ ?>
                <span class="badge-green">Approved</span>
            <?php } elseif($row['status']=="Rejected"){ ?>
                <span class="badge-red">Rejected</span>
            <?php } else { ?>
                <span class="badge-yellow">Pending</span>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>

<?php } if(mysqli_num_rows($res) == 0) { ?>

<tr>
<td colspan="4" class="no-data-cell">
    No leave records found
</td>
</tr>

<?php } ?>

</table>

</div>

<!-- 🔥 SEARCH -->
<div class="bottom-search-wrapper <?php if($total==0) echo 'no-data-mode'; ?>">

    <div class="bottom-search-row">
        <input type="text" placeholder="🔍 Type">
        <input type="text" placeholder="🔍 From Date">
        <input type="text" placeholder="🔍 To Date">
        <input type="text" placeholder="🔍 Status">
    </div>

</div>

</div>

</div>

<?php include 'includes/my_leaves_footer.php'; ?>