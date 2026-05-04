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

            <form method="post">

                <label>Leave Type</label>
                <select name="type" required>
                    <option value="">-- Select Leave Type --</option>
                    <option>Casual Leave</option>
                    <option>Sick Leave</option>
                    <option>Earned Leave</option>
                </select>

                <div class="date-row">
                    <div>
                        <label>From Date</label>
                        <input type="date" id="fromDate" name="from" required>
                    </div>

                    <div>
                        <label>To Date</label>
                        <input type="date" id="toDate" name="to" required>
                    </div>
                </div>

                <label>No. of Days</label>
                <input type="text" id="days" readonly placeholder="0 Days">

                <label>Reason</label>
                <textarea name="reason" required></textarea>

                <div class="btn-row">

                    <!-- ✅ FIXED BUTTON -->
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