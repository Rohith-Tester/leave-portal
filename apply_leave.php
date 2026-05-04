<?php include 'includes/apply_leave_handler.php'; ?>
<?php include 'includes/apply_leave_header.php'; ?>

<body>

<a href="dashboard.php" class="top-back-btn">← Back</a>

<div class="page-title">Employee Leave Portal</div>

<div class="apply-layout">

    <!-- LEFT SIDE -->
    <div class="leave-balance">

        <h2>Leave Balance</h2>

        <div class="bal-card blue">
            <h3><?php echo $casual; ?></h3>
            <p>Casual Leave</p>
        </div>

        <div class="bal-card green">
            <h3><?php echo $sick; ?></h3>
            <p>Sick Leave</p>
        </div>

        <div class="bal-card orange">
            <h3><?php echo $earned; ?></h3>
            <p>Earned Leave</p>
        </div>

        <div class="bal-card purple">
            <h3><?php echo $total; ?></h3>
            <p>Total Remaining</p>
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="form-side">

        <div class="apply-box">

            <div class="form-header">
                <h2>Apply Leave</h2>
                <p>Fill the details below to apply for leave</p>
            </div>

            <form method="post" id="leaveForm">

<label>Leave Type</label>
<select name="type" id="type">
    <option value="">-- Select Leave Type --</option>
    <option>Casual Leave</option>
    <option>Sick Leave</option>
    <option>Earned Leave</option>
</select>
<span class="error-msg" id="typeError"></span>

<div class="date-row">

    <div>
        <label>From Date</label>
        <input type="date" id="fromDate" name="from">
        <span class="error-msg" id="fromError"></span>
    </div>

    <div>
        <label>To Date</label>
        <input type="date" id="toDate" name="to">
        <span class="error-msg" id="toError"></span>
    </div>

</div>

<label>No. of Days</label>
<input type="text" id="days" readonly placeholder="0 Days">

<label>Reason</label>
<textarea name="reason" id="reason"></textarea>
<span class="error-msg" id="reasonError"></span>

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

        <div class="note-box">
            <strong>Note:</strong> Your leave request will be sent to admin for approval.
        </div>

    </div>

</div>

<?php include 'includes/apply_leave_footer.php'; ?>