<!-- Sign up successful message -->
<div>
    <?php
    if (isset($_GET["signup"]) && $_GET["signup"] == "success") {
        echo "<p class=\"signupSuccess\">You have successfully registered to the system! Please login to continue.</p>";
    }
    ?>
</div>

<!--Login Form-->

<div class="container form-container">

    <div class="form-congtainer-in">
        <div>
            <img src="<?= WEBROOT ?>HomeImages/Navbar Logo.jpg" class="userImage">
        </div>

        <div>
            <form action="<?php echo WEBROOT . 'login'; ?>" method="POST" class="loginForm">

                <?php
                if (isset($error)) {
                    switch ($error) {
                        case 'empty_fields':
                            echo "<p class=\"formError\">Some required fields are empty. Login failed. Please try again.</p>";
                            break;
                        case 'user_not_found':
                            echo "<p class=\"formError\">User not found, please try again.</p>";
                            break;
                        case 'wrong_password':
                            echo "<p class=\"formError\">Invalid login, please try again.</p>";
                            break;
                        default:
                            echo "<p class=\"formError\">Errors in your submission. Please try again.</p>";
                            break;
                    }
                }
                ?>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>

                <br>
                <div class="">
                    <button type="submit" class="btn" name="submit">Log in</button>
                </div>
                <div class="container">
                    <p style="text-align: center; margin-top: 20px;">Don't have an account? <a href="signup" class="signuptag" style="color: #174966;">Sign Up</a> today!!!</p>
                </div>
            </form>
        </div>
    </div>

</div>