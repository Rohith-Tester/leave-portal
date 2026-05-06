<?php include 'includes/login_handler.php'; ?>
<?php include 'includes/login_header.php'; ?>

<body>

<div class="login-wrapper">

    <div class="left-panel">

        <h1>Leave <span>Portal</span></h1>

        <p>
        Manage your leaves seamlessly, anytime, anywhere.
        </p>

    </div>

    <div class="right-panel">

        <div class="login-card">

            <div class="user-icon">👤</div>

            <h2>Welcome Back!</h2>

            <p class="sub">
            Sign in to continue
            </p>

            <?php if($msg!=""){ ?>

                <p style="color:red; margin-bottom:12px;">

                    <?php echo $msg; ?>

                </p>

            <?php } ?>

            <form method="POST"
            id="loginForm"
            novalidate
            autocomplete="off">

                <!-- 🔥 ROLE TOGGLE -->

                <div class="role-toggle">

                    <button type="button"
                    id="userBtn"
                    class="role-btn active-role"
                    onclick="setRole('user')">

                    User

                    </button>

                    <button type="button"
                    id="adminBtn"
                    class="role-btn"
                    onclick="setRole('admin')">

                    Admin

                    </button>

                </div>

                <!-- 🔥 HIDDEN ROLE -->

                <input type="hidden"
                name="login_role"
                id="login_role"
                value="user">

                <!-- USERNAME -->

                <div class="input-box">

                    <input type="text"
                    id="username"
                    name="username"
                    placeholder="Username"
                    autocomplete="off">

                    <small class="error-msg"
                    id="userError"></small>

                </div>

                <!-- PASSWORD -->

                <div class="input-box">

                    <div class="password-box">

                        <input type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        autocomplete="new-password">

                        <i class="fa-solid fa-eye eye-toggle"
                        onclick="togglePassword('password',this)">
                        </i>

                    </div>

                    <small class="error-msg"
                    id="passError"></small>

                </div>

                <!-- OPTIONS -->

                <div class="option-row">

                    <label>

                        <input type="checkbox">

                        Remember me

                    </label>

                    <a href="forget_password.php">

                        Forgot password?

                    </a>

                </div>

                <!-- LOGIN BUTTON -->

                <button type="submit"
                name="login"
                class="login-btn">

                Login

                </button>

            </form>

            <!-- DIVIDER -->

            <div class="divider">OR</div>

            <!-- LINKS -->

            <div class="bottom-link">

                <span>
                Already have an account?
                </span>

                <a href="login.php">
                Login →
                </a>

            </div>

            <div class="bottom-link">

                <span>
                Don't have an account?
                </span>

                <a href="register.php">
                Register →
                </a>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/login_footer.php'; ?>