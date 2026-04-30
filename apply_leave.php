<?php include 'includes/apply_leave_handler.php'; ?>
<?php include 'includes/apply_leave_header.php'; ?>

<body>

<a href="dashboard.php" class="top-back-btn">← Back</a>

<div class="page-title">Employee Leave Portal</div>

<div class="apply-layout">

<div class="leave-balance">

<div class="top-dashboard">
<a href="dashboard.php">Dashboard</a>
</div>

<h2>Leave Balance</h2>

<div class="bal-card">
<h3><?php echo $casual; ?></h3>
<p>Casual Leave</p>
</div>

<div class="bal-card">
<h3><?php echo $sick; ?></h3>
<p>Sick Leave</p>
</div>

<div class="bal-card">
<h3><?php echo $earned; ?></h3>
<p>Earned Leave</p>
</div>

<div class="bal-card">
<h3><?php echo $total; ?></h3>
<p>Total Remaining</p>
</div>

</div>

<div class="form-side">

<div class="apply-box">

<?php if($msg!=""){ ?>
<div class="ok-msg"><?php echo $msg; ?></div>
<?php } ?>

<form method="post">

<select name="type" required>
<option value="">Select Leave Type</option>
<option>Casual Leave</option>
<option>Sick Leave</option>
<option>Earned Leave</option>
</select>

<input type="date" name="from" required>

<input type="date" name="to" required>

<input type="text" name="reason" placeholder="Reason" required>

<div class="btn-row">

<button type="submit" name="submit" class="blue-btn">
Submit
</button>

<button type="reset" class="cancel-btn">
Cancel
</button>

</div>

</form>

</div>

</div>

</div>

<?php include 'includes/apply_leave_footer.php'; ?>