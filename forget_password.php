<?php include 'includes/forget_handler.php'; ?>
<?php include 'includes/forget_header.php'; ?>

<body>

<div class="login-wrapper">

<div class="left-panel">

<h1>Leave <span>Portal</span></h1>

<p>
Reset your password securely and continue using portal.
</p>

</div>

<div class="right-panel">

<div class="login-card">

<div class="user-icon">👤</div>

<h2>Reset Password</h2>

<p class="sub">
Verify using Email or Mobile
</p>

<?php if($msg!=""){ ?>

<p style="color:red; margin-bottom:10px;">
<?php echo $msg; ?>
</p>

<?php } ?>

<form method="POST"
id="forgetForm"
novalidate
autocomplete="off">

<div class="input-box">

<input type="text"
id="username"
name="username"
placeholder="Username"
autocomplete="off">

<small class="error-msg" id="userError"></small>

</div>

<div class="input-box">

<div class="email-row">

<div class="email-main">

<input type="text"
id="verify"
name="verify"
placeholder="Email Address or Mobile"
autocomplete="off"
oninput="checkForgetEmail()">

<span id="verifyMailBtn"
class="verify-link"
onclick="sendForgetOTP()">

Verify OTP

</span>

</div>

<div id="forgetOtpArea"></div>

</div>

<small id="verifyStatus"></small>

<small class="error-msg" id="verifyError"></small>

</div>

<div class="input-box">

<div class="password-box">

<input type="password"
id="newpass"
name="newpass"
placeholder="New Password"
autocomplete="new-password"
oninput="checkForgetStrength();checkForgetMatch()">

<i class="fa-solid fa-eye eye-toggle"
onclick="togglePassword('newpass',this)">
</i>

</div>

<small id="forgetStrength"></small>

<small class="error-msg" id="passError"></small>

</div>

<div class="input-box">

<div class="password-box">

<input type="password"
id="confirmpass"
name="confirmpass"
placeholder="Confirm Password"
autocomplete="new-password"
oninput="checkForgetMatch()">

<i class="fa-solid fa-eye eye-toggle"
onclick="togglePassword('confirmpass',this)">
</i>

</div>

<small id="forgetMatch"></small>

<small class="error-msg" id="cpassError"></small>

</div>

<input type="submit"
name="update"
value="Update Password"
class="login-btn">

</form>

<div class="bottom-link">

<a href="login.php">
← Back to Login
</a>

</div>

</div>
</div>
</div>

<script>

const verifyInput =
document.getElementById("verify");

const verifyBtn =
document.getElementById("verifyMailBtn");

const verifyStatus =
document.getElementById("verifyStatus");

/* Disable Initially */

verifyBtn.classList.add("verify-disabled");

function checkForgetEmail(){

let contact = verifyInput.value.trim();

if(contact == ""){

verifyStatus.innerHTML = "";

verifyBtn.classList.remove("verify-enabled");
verifyBtn.classList.add("verify-disabled");

return;
}

let xhr = new XMLHttpRequest();

xhr.open("POST","check_email.php",true);

xhr.setRequestHeader(
"Content-type",
"application/x-www-form-urlencoded"
);

xhr.onload = function(){

let response = this.responseText.trim();

if(response == "exists"){

verifyStatus.innerHTML =
"<span class='account-found'>Account Found</span>";

verifyBtn.classList.remove("verify-disabled");
verifyBtn.classList.add("verify-enabled");

}else{

verifyStatus.innerHTML =
"<span class='password-strength'>Email or Mobile not registered</span>";

verifyBtn.classList.remove("verify-enabled");
verifyBtn.classList.add("verify-disabled");

}

};

xhr.send(
"contact=" + encodeURIComponent(contact)
);

}

</script>

<?php include 'includes/forget_footer.php'; ?>