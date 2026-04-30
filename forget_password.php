<?php include 'includes/forget_handler.php'; ?>
<?php include 'includes/forget_header.php'; ?>

<body>

<div class="login-wrapper">

<div class="left-panel">
<h1>Leave <span>Portal</span></h1>
<p>Reset your password securely and continue using portal.</p>
</div>

<div class="right-panel">

<div class="login-card">

<div class="user-icon">👤</div>

<h2>Reset Password</h2>
<p class="sub">Verify using Email or Mobile</p>

<?php if($msg!=""){ ?>
<p style="color:red; margin-bottom:10px;"><?php echo $msg; ?></p>
<?php } ?>

<form method="POST" id="forgetForm" novalidate>

<div class="input-box">
<input type="text" id="username" name="username" placeholder="Username">
<small class="error-msg" id="userError"></small>
</div>

<div class="email-row">

    <div class="email-main">

        <input type="text"
        id="verify"
        name="verify"
        placeholder="Email Address"
        oninput="checkForgetEmail()">

        <span id="verifyMailBtn"
        class="verify-link"
        onclick="sendForgetOTP()">
        Verify OTP
        </span>

    </div>

    <div id="forgetOtpArea"></div>

</div>

<small class="error-msg" id="verifyError"></small>
<small id="verifyStatus"></small>

<div class="input-box">

<div class="password-box">

<input type="password"
id="newpass"
name="newpass"
placeholder="New Password"
oninput="checkForgetStrength();checkForgetMatch()">

<i class="fa-solid fa-eye eye-toggle"
onclick="togglePassword('newpass',this)"></i>

</div>

<small id="forgetStrength"></small>
<small class="error-msg" id="passError"></small>

</div>

<div class="input-box">

<div class="input-box">

<div class="password-box">

<input type="password"
id="confirmpass"
name="confirmpass"
placeholder="Confirm Password"
oninput="checkForgetMatch()">

<i class="fa-solid fa-eye eye-toggle"
onclick="togglePassword('confirmpass',this)"></i>

</div>

<small id="forgetMatch"></small>
<small class="error-msg" id="cpassError"></small>

</div>

<input type="submit" name="update" value="Update Password" class="login-btn">

</form>

<div class="bottom-link">
<a href="login.php">← Back to Login</a>
</div>

</div>
</div>
</div>

<?php include 'includes/forget_footer.php'; ?>