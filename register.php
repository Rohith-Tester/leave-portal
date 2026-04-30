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

            <?php if($msg!=""){ ?>
                <p style="color:red; margin-bottom:10px;"><?php echo $msg; ?></p>
            <?php } ?>

            <form method="POST" id="registerForm" novalidate>

                <!-- Full Name -->
                <div class="input-box">
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name">
                    <small class="error-msg" id="nameError"></small>
                </div>

                <!-- Username -->
                <div class="input-box">

                    <input type="text"
                    id="username"
                    name="username"
                    placeholder="Username"
                    oninput="checkUsername()">

                    <small class="error-msg" id="userError"></small>
                    <small id="userStatus"></small>

                </div>

                <!-- Email -->
                <div class="email-row">

                    <div class="input-box email-box">

                        <input type="email"
                        id="email"
                        name="email"
                        placeholder="Email Address"
                        oninput="checkEmailForOTP()">

                        <span id="verifyBtn" class="verify-link">
                            Verify OTP
                        </span>

                        <small class="error-msg" id="emailError"></small>
                        <small id="emailStatus"></small>

                    </div>

                    <div id="otpArea"></div>

                </div>

                <!-- Mobile -->
                <div class="mobile-row">

                    <div class="input-box mobile-box">

                        <div class="country-wrap">
                            <select id="countryCode" name="countryCode" class="country-select">
                                <option value="+91">🇮🇳 +91</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+44">🇬🇧 +44</option>
                                <option value="+61">🇦🇺 +61</option>
                                <option value="+971">🇦🇪 +971</option>
                                <option value="+65">🇸🇬 +65</option>
                                <option value="+81">🇯🇵 +81</option>
                                <option value="+49">🇩🇪 +49</option>
                                <option value="+33">🇫🇷 +33</option>
                                <option value="+86">🇨🇳 +86</option>
                                <option value="+94">🇱🇰 +94</option>
                                <option value="+92">🇵🇰 +92</option>
                                <option value="+880">🇧🇩 +880</option>
                            </select>
                        </div>

                        <input type="text"
                        id="mobile"
                        name="mobile"
                        maxlength="10"
                        placeholder="Mobile Number"
                        onkeyup="checkMobileForOTP()">

                        <span id="mobileVerifyBtn"
                        class="verify-link"
                        onclick="sendMobileOTP()">
                            Verify OTP
                        </span>

                        <small class="error-msg" id="mobileError"></small>

                    </div>

                    <div id="mobileOtpArea"></div>

                </div>

                <!-- Password -->
                <div class="input-box">

                    <div class="password-box">

                        <input type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
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
                        onkeyup="checkPasswordMatch()">

                        <i class="fa-solid fa-eye eye-toggle"
                        onclick="togglePassword('confirm_password',this)"></i>

                    </div>

                    <small id="matchStatus"></small>
                    <small class="error-msg" id="cpassError"></small>

                </div>

                <!-- Role -->
                <select name="role" id="role" class="role-select">
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