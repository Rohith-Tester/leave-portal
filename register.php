<?php include 'includes/register_handler.php'; ?>
<?php include 'includes/register_header.php'; ?>

<body>

<div class="login-wrapper">

    <div class="left-panel">
        <h1>Leave <span>Portal</span></h1>
        <p>Create account and manage your leaves easily.</p>
    </div>

    <div class="right-panel">

        <div class="login-card">

            <div class="user-icon">👤</div>

            <h2>Create Account</h2>
            <p class="sub">Register to continue</p>

            <?php if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register']) && !empty($msg)) { ?>
                <p class="error-msg"><?php echo $msg; ?></p>
            <?php } ?>

            <!-- 🔥 AUTOFILL OFF -->
            <form method="POST" autocomplete="off">

                <!-- 🔥 FAKE FIELDS (Chrome trick) -->
                <input type="text" name="fakeuser" style="display:none">
                <input type="password" name="fakepass" style="display:none">

                <!-- Full Name -->
                <div class="input-box">
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" autocomplete="off">
                    <small class="error-msg" id="nameError"></small>
                </div>

                <!-- Username -->
                <div class="input-box">

                    <input type="text"
                    id="username"
                    name="username"
                    placeholder="Username"
                    autocomplete="off"
                    oninput="checkUsername()">

                    <small class="error-msg" id="userError"></small>
                    <small id="userStatus"></small>

                </div>

                <!-- Email / Mobile -->
                <div class="email-row">

                    <div class="input-box email-box">

                        <input type="text"
                        id="contact"
                        name="contact"
                        placeholder="Enter Email or Mobile Number"
                        autocomplete="off"
                        oninput="checkContactForOTP()">

                        <span id="verifyBtn" class="verify-link">
                            Verify OTP
                        </span>

                        <small class="error-msg" id="emailError"></small>
                        <small id="emailStatus"></small>

                    </div>

                    <div id="otpArea"></div>

                </div>

                <!-- Password -->
                <div class="input-box">

                    <div class="password-box">

                        <input type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        autocomplete="new-password"
                        onkeyup="checkPasswordStrength();checkPasswordMatch()">

                        <i class="fa-solid fa-eye eye-toggle"
                        onclick="togglePassword('password',this)"></i>

                    </div>

                    <small id="passwordStrength"></small>
                    <small class="error-msg" id="passError"></small>

                </div>

                <!-- Confirm Password -->
                <div class="input-box">

                    <div class="password-box">

                        <input type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="Confirm Password"
                        autocomplete="new-password"
                        onkeyup="checkPasswordMatch()">

                        <i class="fa-solid fa-eye eye-toggle"
                        onclick="togglePassword('confirm_password',this)"></i>

                    </div>

                    <small id="matchStatus"></small>
                    <small class="error-msg" id="cpassError"></small>

                </div>

                <!-- Role -->
                <select name="role" id="role" class="role-select" autocomplete="off">
                    <option value="">Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <small id="roleError" class="error-text"></small>

                <!-- Captcha -->
                <div class="g-recaptcha"
                data-sitekey="6LcFc84sAAAAAHsgC1edMraBMC5fdV6BJi16MMDl"></div>

                <!-- Register -->
                <input type="submit"
                name="register"
                id="registerBtn"
                value="Register"
                class="login-btn"
                disabled>

            </form>

            <div class="divider">OR</div>

            <div class="bottom-link">
                <span>Already have an account?</span>
                <a href="login.php">Login →</a>
            </div>

        </div>

    </div>

</div>

<?php include 'includes/register_footer.php'; ?>