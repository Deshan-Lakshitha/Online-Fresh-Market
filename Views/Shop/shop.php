<div class="row">
    <div class="titleAndSearch">
        <div class="col">
            <img src="<?= WEBROOT ?>HomeImages/<?= $shop->getImage() ?>" alt="" class="avatar">
            <h1 class="heading_name"><?= $shop->getShopName() ?></h1>
            <h4 class="intro"><?= $shop->getDescription() ?></h4>
        </div>
    </div>

    <!-- Items - As bootstrap cards -->
    <?php
    $select_amount = '<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="amount" id="amount" value="0.25">
  <label class="form-check-label" for="inlineRadio1">250g</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="amount" id="amount" value="0.5">
  <label class="form-check-label" for="inlineRadio2">500g</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="amount" id="amount" value="1">
  <label class="form-check-label" for="inlineRadio2">1kg</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="amount" id="amount" value="2">
  <label class="form-check-label" for="inlineRadio2">2kg</label>
</div>';
    ?>


    <div class="row">

        <div class="col-md-9">

            <div class="container itemCards" style="margin-top: 20px;">
                <div class="row">

                    <?php

                    foreach ($shop_items as $shop_item) {
                        if ($shop_item->is_available == "in stock") {
                            echo '<div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="' . WEBROOT . 'HomeImages/items/' . $shop_item->image . '" class="card-img-top" alt="...">
                            <div class="card-body">
                                 <h5 class="card-title">' . $shop_item->item_name . '</h5>
<!--                                <input type="text" name="text" value="Carrot" disabled style="border-radius: 10px 0px 10px 0px; text-align: center;">-->
                                <p class="card-text">Unit price</p>
                                <p class="card-text2">' . $shop_item->unit_price . ' LKR</p><br>
                                <form action="../shop/' . $shop_id . '" method="get" name="addForm">';
                            echo $select_amount;
                            echo '<input type="hidden" name="item_id" value="' . $shop_item->item_id . '">
                                    <input type="submit" class="btn addBtn" value="Add">
                                </form>
                            </div>
                        </div>
                    </div>';
                        }
                    }

                    if (isset($no_items)) {
                        echo '<h3 style="text-align: center;margin-top:20px;">No items to display</h3>';
                    }
                    ?>

                </div>
            </div>
        </div>

        <div class="col-md-3 divCart">

            <div class="container">
                <h2 class="colHeading">Cart</h2><i class='fas fa-shopping-cart' style='font-size:48px'></i>
            </div>

            <?php if ($cart != []) {
                echo '<form action="../shop/' . $shop_id . '" method="post">
                <div class="container" style="margin-top: 5px">
                <!--            Display added items-->
                <table class="table" id="tbl">
                    <colgroup>
                        <col style="width: 50%">
                        <col style="width: 20%">
                        <col style="width: 30%">
                    </colgroup>
                    <tr>
                        <th>Item name</th>
                        <th>Amount</th>
                        <th style="font-size: small">Unit price LKR</th>
                        <th>Delete item</th>
                    </tr>
                    <tbody>';

                //var_dump($cart);
                //($cart);

                //var_dump($cart);
                if (isset($stock_exceeded)) {
                    echo "<p class=\"error\">Cannot add $stock_exceeded->item_name as stock limit exceeded.<p>";
                }

                $order_num = 0;

                foreach ($cart as $order_item) {
                    //print_r($item);
                    $item_amount = "";
                    $amount_details = explode(".", "$order_item->quantity");

                    // //echo (float) 1;
                    // var_dump($order_item->quantity);
                    // var_dump($amount_details);

                    if (isset($amount_details[1])) {
                        if ($amount_details[0] != "0") {
                            $kilograms = ((int)$amount_details[0]);
                            $item_amount .= "$kilograms" . " kg ";
                        }

                        if ($amount_details[1] != "0") {
                            $zeros_to_add = 3 - strlen($amount_details[1]);
                            //echo $zeros_to_add;

                            for ($i = 0; $i < $zeros_to_add; $i++) {
                                $amount_details[1] = implode("", array($amount_details[1], "0"));
                            }
                            $item_amount .= $amount_details[1] . " g";
                        }
                    } else {
                        if ($amount_details[0] != "0") {
                            $kilograms = ((int)$amount_details[0]);
                            $item_amount .= "$kilograms" . " kg ";
                        }
                    }

                    echo
                        '<tr>
                        <input type="hidden" name="orderShopItemId_' . $order_num . '" value="' . $order_item->shop_item->item_id . '">
                        <input type="hidden" name="orderShopItemQuantity_' . $order_num . '" value="' . $order_item->quantity . '">
                        <td>' . $order_item->shop_item->item_name . '</td>
                        <td>' . $item_amount . '</td>
                        <td>' . $order_item->shop_item->unit_price . '</td>
                        <td> <a href="../shop/' . $shop_id . '?delete=true&item_id=' . $order_item->shop_item->item_id . '"><i class="fas fa-trash" style="font-size:24px; color:crimson;"></i></a> </td>
                     </tr>
                    ';
                    $order_num++;
                }

                $price_details = explode(".", "$total_price");

                if (!isset($price_details[1])) {
                    $price_details[1] = "00";
                } else {
                    if (strlen($price_details[1]) == 1) {
                        $price_details[1] .= "0";
                    }
                }

                $str_price = implode(".", $price_details);

                echo '</tbody>
                </table>
                <h5 class="total_price">Total price is : ' . $str_price . ' LKR</h5>
                    <button type="submit" class="btn" name="create_order">Create order</button>
                </form>
            </div>';
            } else {
                echo '<h4 style="text-align: center;margin-top:20px;">Your cart is empty.</h4>';
            }
            ?>

            <!--Javascript to update table-->
            <script>
                function addToCart(form) {

                    if (form.form.amount.value != '') {
                        var itemName = "Veg X";
                        // var itemName = form.form.text.value;
                        itemName = document.getElementsByClassName('card-title')[0].innerHTML;
                        var amount = form.form.amount.value;
                        var price = 'xxx LKR'

                        var tr = document.createElement('tr');
                        var td1 = tr.appendChild(document.createElement('td'));
                        var td2 = tr.appendChild(document.createElement('td'));
                        var td3 = tr.appendChild(document.createElement('td'));
                        var td4 = tr.appendChild(document.createElement('td'));

                        td1.innerHTML = itemName;
                        td2.innerHTML = amount;
                        td3.innerHTML = price;
                        td4.innerHTML = "<button class=\"btn\" onclick='deleteRow(this)'><i class=\"fa fa-trash\" style='color: crimson'></i></button>";

                        document.getElementById("tbl").appendChild(tr);
                    }
                }

                function deleteRow(r) {
                    var i = r.parentNode.parentNode.rowIndex;
                    document.getElementById("tbl").deleteRow(i);
                }

                console.log()
            </script>

        </div>

    </div>

    <!-- JS for bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>