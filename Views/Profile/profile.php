<?= '<script type="text/javascript" src="' . WEBROOT . 'Views/Javascript/dis_town.js"></script>' ?>

    <div class="container">
        <div class="row">

            <!-- User Profile -->

            <div class="col">
                <div class="heading">
                    <h2 class="heading">Profile</h2>
                </div>

                <br>

                <div class="container">
                    <div class="row">
                        <?php
                        if (isset($user)) {
                            echo '<table class="table" style="border-color: #174966;">
                            <tr>
                                <th>First Name</th>
                                <td>' . $user->getFirstName() . '</td>
                            </tr>
                            <tr>
                                <th>Last Name</th>
                                <td>' . $user->getLastName() . '</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>' . $user->getEmail() . '</td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td>' . $user->getMobileNo() . '</td>
                            </tr>
                            <tr>
                                <th>Postal Address</th>
                                <td>' . $user->getAddress() . '</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>' . $user->getDistrict() . '</td>
                            </tr>
                            <tr>
                                <th>Closest Town</th>
                                <td>' . $user->getCloseTown() . '</td>
                            </tr>
                        </table>';
                        }
                        ?>
                    </div>
                </div>

                <br>

                <div class="raw">
                    <?php
                    if (isset($user)) {
                        if ($user->getAccType() == 'customer') {
                            echo '<a class="btn btn-success" id="seller-btn" href="becomeaseller" role="button">Become A Seller</a>';
                        }
                        echo '<a class="btn btn-danger" id="seller-btn" href="logout" role="button">Sign Out</a>';
                    }
                    ?>
                </div>

                <br>

                <div class="container">
                        <div class="row">

                            <?php if (isset($error_req)) {
                                echo "<p class=\"formError\">Something went wrong. Please try again.</p>";
                            }
                            if (isset($success)) {
                                switch ($success) {
                                    case 'request_accept':
                                        echo "<p class=\"formSuccess\">Successfully registered as a delivery person.</p>";
                                        break;
                                    case 'request_reject':
                                        echo "<p class=\"formSuccess\">You rejected the request.</p>";
                                        break;

                                    default:
                                        break;
                                }
                            } ?>

                            <?php
                            if (isset($requests)) {
                                echo '<div class="heading">
                                        <h2 class="heading">Delivery Person Requests</h2>
                                    </div>
    
                                    <br>';


                                foreach ($requests as $request) {
                                    echo '<form action="'.WEBROOT . 'profile'.'" method="POST">
                                        <div class="row">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> A request from ' . $request->getShopName() . '</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Address : ' . $request->getAddress() . '</li>
                                                    <li class="list-group-item">Contact number : ' . $request->getMobileNo() . '</li>
                                                </ul>
                                                <input type="hidden" id="request_id" name="request_id" value='. $request->getRequestId() .'>
                                                <input type="hidden" id="shop_id" name="shop_id" value='. $request->getShopId() .'>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col"><button type="submit" class="btn btn-success" name="accept">Accept</button></div>
                                                    <div class="col"><button type="submit" class="btn btn-danger" name="reject">Rejected</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>';

                                }
                            }
                            ?>
                        </div>
                </div>
            </div>

            <!-- Update Profile -->

            <div class="col">

                <div class="heading">
                    <h2 class="heading">Update Profile</h2>
                </div>

                <!-- PHP block to display errors -->

                <?php
                if (isset($error_profile)) {
                    switch ($error_profile) {
                        case 'field_length_exceeded':
                            echo "<p class=\"formError\">Some field lengths exceeded. Update failed. Please try again.</p>";
                            break;
                        case 'invalid_names':
                            echo "<p class=\"formError\">Invalid type for name. Update failed. Please try again.</p>";
                            break;
                        case 'invalid_mobile_no':
                            echo "<p class=\"formError\">Invalid mobile number. Number must have exactly 10 digits and start with 07. Update failed. Please try again.</p>";
                            break;
                        case 'wrong_password':
                            echo "<p class=\"formError\">Wrong Password. Update failed. Please try again.</p>";
                            break;
                        default:
                            echo "<p class=\"formError\">Errors in your submission. Please try again.</p>";
                            break;
                    }
                }
                if (isset($success_profile)) {
                    echo "<p class=\"formSuccess\">Successfully Updated.</p>";
                }

                ?>

                <br>

                <div class="container">

                    <form action="<?php echo WEBROOT . 'profile'; ?>" method="POST">

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="new_first_name" name="new_first_name" value="<?= isset($error_profile) ? $data['new_first_name'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="new_last_name" name="new_last_name" value="<?= isset($error_profile) ? $data['new_last_name'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="mobileNo" class="form-label">Mobile Numeber</label>
                                    <input type="text" class="form-control" placeholder="07X1234567" aria-label="Recipient's username" aria-describedby="basic-addon2" name="new_mobile_no" value="<?= isset($error_profile) ? $data['new_mobile_no'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="address" class="form-label">Postal Address</label>
                                    <input type="text" class="form-control" id="new_address" name="new_address" placeholder="2/40, Temple Street, Galle." value="<?= isset($error_profile) ? $data['new_address'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="district" class="form-label">District</label>
                                    <select class="town_dis_sel" name="new_district" id="district" style="width: 50%;">
                                        <option value="" selected="selected">Select district</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="closeTown" class="form-label">Closest Town</label>
                                    <select class="town_dis_sel" name="new_close_town" id="close_town" style="width: 40%;">
                                        <option value="" selected="selected">Select town</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="password" class="form-label">Password <label style="color: crimson;">*
                                            (To update details you must enter your password)</label></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn" name="submit">Update Profile</button>
                            </div>
                            <div class="col"><label for="" style="color: crimson;">* required fields</label></div>
                        </div>
                    </form>
                </div>

                <div class="heading">
                    <h2 class="heading">Update Password</h2>
                </div>

                <?php
                if (isset($error_password)) {
                    switch ($error_password) {
                        case 'password_mismatch':
                            echo "<p class=\"formError\">Two passwords are not matching. Update failed. Please try again.</p>";
                            break;
                        case 'wrong_password':
                            echo "<p class=\"formError\">Wrong Password. Update failed. Please try again.</p>";
                            break;
                        case 'empty_password' :
                            echo "<p class=\"formError\">Empty fields. Update failed. Please try again.</p>";
                            break;
                        default:
                            echo "<p class=\"formError\">Errors in your submission. Please try again.</p>";
                            break;
                    }
                }
                if (isset($success_password)) {
                    echo "<p class=\"formSuccess\">Successfully Updated.</p>";
                }
                ?>

                <br>

                <div class="container">

                    <form action="<?php echo WEBROOT . 'profile'; ?>" method="POST">

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="password" class="form-label">Current Password <label style="color: crimson;">*</label></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="password" class="form-label">New Password <label style="color: crimson;">*</label></label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="password" class="form-label">Confirm New Password <label style="color: crimson;">*</label></label>
                                    <input type="password" class="form-control" id="c_new_password" name="c_new_password">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn" name="password_submit">Update Password</button>
                            </div>
                            <div class="col"><label for="" style="color: crimson;">* required fields</label></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>