<?= '<script type="text/javascript" src="' . WEBROOT . 'Views/Javascript/dis_town.js"></script>' ?>

<h1 style="margin-top: 20px; margin-left: 5px; color: #174966; font-family: 'Roboto Slab', serif;">Become A Seller</h1>

<div class="container">
    <form method="post" action="becomeASeller" enctype="multipart/form-data">

        <?php
        if ($formErr) {
            echo "<p class=\"formError\">Some required fields in the form are empty or invalid.</p>";
        }
        if (isset($mobile_num_error) && $mobile_num_error)
            echo "<p class=\"formError\">Invalid mobile number. Number must have exactly 10 digits and start with 0XX. Registration failed. Please try again.</p>";

        if (!isset($formErr)) {
            switch ($uploadErr) {
                case "img_invalid":
                    echo "<p class=\"formError\">The selected file is not an image.</p>";
                    break;
                case "img_no_file":
                    echo "<p class=\"formError\">No file selected.</p>";
                    break;
                case "img_exists";
                    echo "<p class=\"formError\">File already exists. Please try again.</p>";
                    break;
                case "img_failed":
                    echo "<p class=\"formError\">File upload failed in the server. Please try again.</p>";
                    break;
                case "img_type_error":
                    echo "<p class=\"formError\">Image type you selected is not valid.</p>";
                    break;
                case "img_large":
                    echo "<p class=\"formError\">Image file you selected is too large.</p>";
                    break;
            }
        }
        ?>

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shop_name">Shop Name <label style="color: crimson;">*</label> </label>
                        <input type="text" name="shop_name" id="shop_name" class="form-control"
                               value="<?= $formData['shop_name'] ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="address">Address <label style="color: crimson;">*</label> </label>
                        <input type="text" name="address" id="address" class="form-control"
                               value="<?= $formData['address'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="mb-3">
            <!--            <div class="row">-->
            <!--                <div class="col">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="district">District <label style="color: crimson;">*</label> </label>-->
            <!--                        <input type="text" name="district" id="district" class="form-control"-->
            <!--                               value="--><? //= $formData['district'] ?><!--">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="col">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="close_town">Close Town <label style="color: crimson;">*</label> </label>-->
            <!--                        <input type="text" name="close_town" id="close_town" class="form-control"-->
            <!--                               value="--><? //= $formData['close_town'] ?><!--">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

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

        <div class="mb-3">
            <div class="row">
                <div class="col">
                    <label for="mobileNo" class="form-label">Mobile numeber <label
                                style="color: crimson;">*</label></label>
                    <input type="text" class="form-control" value="<?= $formData['mobile_no'] ?>" placeholder="07X1234567" aria-label="Recipient's username"
                           aria-describedby="basic-addon2" name="mobile_no">
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="image">Image </label>
                        <input type="file" name="image" id="image" class="form-control"
                               value="<?= $formData['image'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="mb-3">
            <div class="row">
                <div class="form-group">
                    <label for="description">Description </label>
                    <input type="text" name="description" id="description" class="form-control"
                           value="<?= $formData['description'] ?>">
                </div>
            </div>
        </div>
        <br>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn" name="submit">Register</button>
                </div>
                <div class="col"><label for="" style="color: crimson;">* Required fields</label></div>
            </div>
        </div>

    </form>
</div>