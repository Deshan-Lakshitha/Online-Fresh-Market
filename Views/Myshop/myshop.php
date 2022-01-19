<h1 style="margin-top: 20px; margin-left: 5px; color: #174966; font-family: 'Roboto Slab', serif;">My Shop</h1>
<?php
if (isset($shop_info) && $shop_info["shop_name"] != "") {
    ?>

    <div class="shop_info">
        <h5><i class='fas fa-city'
               style='font-size:24px; margin-right: 5px; color: #2FDD92;'></i><?= $shop_info["shop_name"] ?></h5>
        <h5><i class='fas fa-compass'
               style='font-size:24px; margin-right: 5px; color: #2FDD92;'></i><?= $shop_info["address"] ?></h5>
    </div>

    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class='fas fa-carrot'
                                                                                      style='font-size:24px; margin-right: 5px;'></i>Current
                        Items</h5>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                 data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

                    <?php
                    if (isset($update)) {
                        if ($update == "success")
                            echo "<p class=\"update_success\">Shop updated successfully </p>";
                        else
                            echo "<p class=\"update_error\">Error updating shop. Please try agin</p>";
                    }
                    ?>

                    <h6>Click on a field to update item details</h6>

                    <input type="hidden" name="user_id" value="' . $item->getShopId() . '">

                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Item id</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Availability</th>
                            <th>Unit price</th>
                            <th></th>
                        </tr>
                        <?php
                        if (isset($items)) {
                            foreach ($items as $item) {
                                echo '<form class="reqForm" action="myshop" method="post">';
                                echo '<tr>
                <td>' . $item->getItemId() . '</td>
                  <input class="input_update" type="hidden" name="item_id" value="' . $item->getItemId() . '">
                <td> ' . $item->getItemName() . '</td>
                <td><input class="input_update" type="text" name="quantity" value="' . $item->getQuantity() . '"></td>
                <td><select class="form-select form-select-sm" aria-label="Default select example" name="is_available">
                  <option selected>' . $item->getIsAvailable() . '</option>
                  <option value="in stock">in stock</option>
                  <option value="out of stock">out of stock</option>
                  </select>
                </td>
                <td><input class="input_update" type="text" name="unit_price" value="' . $item->getUnitPrice() . '"></td>
                <td><button class="btn-dark save btn" type="submit" name="save" onclick="return confirm(\'Are you sure you want to update these item details?\');">Save</button></td>
                </tr>';
                                echo '</form>';
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseOne">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class='fas fa-plus'
                                                                                      style='font-size:24px; margin-right: 5px;'></i>Add
                        a new item</h5>
                </button>
            </h2>

            <?php
            if (isset($error) || isset($add_new))
                echo '<div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">';
            else
                echo '<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">';
            ?>

            <div class="accordion-body">

                <form class="add_new_form" action="myshop" method="post" enctype="multipart/form-data">

                    <?php
                    if (isset($error)) {
                        switch ($error) {
                            case 'not_int':
                                echo "<p class=\"update_error\">Quantity and Unit Price must be numbers only. Please try again</p>";
                                break;
                            case 'empty_fields':
                                echo "<p class=\"update_error\">Some required fields are empty. Please try agin</p>";
                                break;
                            case 'failed':
                                echo "<p class=\"update_error\">Item adding failed. Please try agin</p>";
                                break;
                            case 'img_invalid':
                                echo "<p class=\"update_error\">Image file is invalid.</p>";
                                break;
                            case 'img_exists':
                                echo "<p class=\"update_error\">Image already exists. Try renaming the image.</p>";
                                break;
                            case 'img_large':
                                echo "<p class=\"update_error\">Image size is too large(Max: 5MB)</p>";
                                break;
                            case 'img_type_error':
                                echo "<p class=\"update_error\">Invalid image type. Must be type jpg, jpeg or png</p>";
                                break;
                            case 'img_failed':
                                echo "<p class=\"update_error\">Image file error. Please try agin</p>";
                                break;
                            default:
                                break;
                        }
                    }
                    if (isset($add_new)) {
                        if ($add_new == "success")
                            echo "<p class=\"update_success\">Item added to the shop successfully.</p>";
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="itemName" class="form-label">Item name <label style="color: crimson;">*</label></label>
                            <input type="text" class="form-control" id="item_name" name="item_name" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Initial quantity(kg) <label
                                        style="color: crimson;">*</label></label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="unitPrice" class="form-label">Unit price(LKR) <label
                                        style="color: crimson;">*</label></label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Image </label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn" name="add">Add</button>
                        </div>
                        <div class="col"><label for="" style="color: crimson;">* Required fields</label></div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    </div>

    <?php
} else
    echo "<div style=\"margin-left:10px; text-align:center;\"><h4>Currently you have no shop on your own.</h4><div><h5>Want to create a shop?</h5></div><div><p>Click <a href=\"becomeASeller\" style=\"color: crimson;\">here</a> to create your shop now with few easy steps.</p><p>Become a seller in our Online Fresh Market platform to grow your business</p></div></div>";
?>
