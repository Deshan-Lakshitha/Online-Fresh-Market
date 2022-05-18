<?= '<script type="text/javascript" src="' . WEBROOT . 'Views/Javascript/dis_town.js"></script>' ?>

<div class="heading">
    <h1 class="Hsign">Sign Up</h1>
    <p class="Hp">Already have an account? <a href="<?= WEBROOT . 'login'; ?>" style="color: #174966;">Sign In</a></p>
</div>

<!-- Registration form -->
<div class="container">
    <form action="<?php echo WEBROOT . 'signup'; ?>" method="POST">

        <!-- Form error display -->
        <?php
        if (isset($error)) {
            switch ($error) {
                case 'empty_fields':
                    echo "<p class=\"formError\">Some required fields are empty. Registration failed. Please try again.</p>";
                    break;
                case 'field_length_exceeded':
                    echo "<p class=\"formError\">Some field lengths exceeded. Registration failed. Please try again.</p>";
                    break;
                case 'invalid_names':
                    echo "<p class=\"formError\">Invalid type for name. Registration failed. Please try again.</p>";
                    break;
                case 'invalid_email':
                    echo "<p class=\"formError\">Invalid type for email. Registration failed. Please try again.</p>";
                    break;
                case 'invalid_mobile_no':
                    echo "<p class=\"formError\">Invalid mobile number. Number must have exactly 10 digits and start with 07X. Registration failed. Please try again.</p>";
                    break;
                case 'password_mismatch':
                    echo "<p class=\"formError\">Two passwords are not matching. Registration failed. Please try again.</p>";
                    break;
                case 'user_exists':
                    echo "<p class=\"formError\">The email you entered already exists. Registration failed. Please try again.</p>";
                    break;
                default:
                    echo "<p class=\"formError\">Errors in your submission. Please try again.</p>";
                    break;
            }
        }
        ?>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="firstName" class="form-label">First name <label
                                style="color: crimson;">*</label></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $data['first_name'] ?>">

                </div>
                <div class="col">
                    <label for="lastName" class="form-label">Last name <label style="color: crimson;">*</label></label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $data['last_name'] ?>">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="email" class="form-label">Email address <label style="color: crimson;">*</label></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="example@email.com" value="<?= $data['email'] ?>">
                </div>
                <div class="col">
                    <label for="mobileNo" class="form-label">Mobile numeber <label
                                style="color: crimson;">*</label></label>
                    <input type="text" class="form-control" placeholder="07X1234567" aria-label="Recipient's username"
                           aria-describedby="basic-addon2" name="mobile_no" value="<?= $data['mobile_no'] ?>">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="password" class="form-label">Password <label style="color: crimson;">*</label>
                        <i class='far fa-eye' style='font-size:20px; color: #174966; margin-left: 10px;'
                           onclick="togglePwView(this)"></i></label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col">
                    <label for="confirmPassword" class="form-label">Confirm Password <label
                                style="color: crimson;">*</label></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
            </div>

            <!-- JS to handle show/hide passwords -->
            <?php echo '<script type="text/javascript" src="' . WEBROOT . 'Views/Javascript/pwd_show_hide.js"></script>'; ?>

        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="address" class="form-label">Postal address <label
                                style="color: crimson;">*</label></label>
                    <input type="text" class="form-control" id="address" name="address"
                           placeholder="2/40, Temple Street, Galle." value="<?= $data['address'] ?>">
                </div>
            </div>
        </div>

        <br>
        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="district" class="form-label">District <label style="color: crimson;">*</label></label>
                    <select class="town_dis_sel" name="district" id="district">
                        <option value="" selected="selected">Select district</option>
                    </select>
                </div>
                <div class="col">
                    <label for="closeTown" class="form-label">Closest town <label
                                style="color: crimson;">*</label></label>
                    <select class="town_dis_sel" name="close_town" id="close_town">
                        <option value="" selected="selected">Select town</option>
                    </select>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn" name="submit">Register</button>
            </div>
            <div class="col"><label for="" style="color: crimson;">* Required fields</label></div>
        </div>

    </form>

</div>

<!-- Bottom scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

