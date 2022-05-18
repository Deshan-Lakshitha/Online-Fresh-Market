<!--Topic-->
<div class="topic">
    <?php
    if (isset($shopDetails) && $shopDetails["shop_name"] != "") {
        echo '<h1 style="margin-top: 20px; margin-left: 5px; color: #174966; font-family: \'Roboto Slab\', serif;">' . $shopDetails["shop_name"] . '</h1>';
    ?>
</div>


    <!--Pending-->
    <?php
        $error = "";
        if (isset($orderError) && $orderError)
            $error = "<p class=\"label-rejected\">Order amount exceeds stock amount. Cannot accept this order.</p>";
    ?>
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-hourglass-half" style='font-size:24px; margin-right: 5px;'></i>Pending
                        <?php
                        if (isset($pending)){
                            if (!count($pending)==0) { echo '<span class="badge badge-pill badge-success">'.count($pending).'</span>'; }
                        }
                        ?>
                    </h5>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">

                        <?php
                        if (isset($pending)) {
                            if (!count($pending)==0){
                                foreach ($pending as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">                                        
                                        <div class="card">
                                            <div class="card-body">'. $error .'
                                                <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';

                                    }
                                    echo '
                                                </ul></div>
                                                <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2"><button type="submit" class="btn btn-secondary" name="accept" value="' . $sellerOrder->getOrderId() . '">Accept</button></div>
                                                    <div class="col-sm-2"><button type="submit" class="btn btn-danger" name="reject" value="' . $sellerOrder->getOrderId() . '">Reject</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>';
                                }
                            } else { echo '<h6 class="card-title">No Pending items to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Unassigned-->
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-binoculars" style='font-size:24px; margin-right: 5px;'></i>Unassigned
                        <?php
                        if (isset($unassigned)){
                            if (!count($unassigned)==0) { echo '<span class="badge badge-pill badge-success">'.count($unassigned).'</span>'; }
                        }
                        ?>
                    </h5>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">

                        <?php
                        if (isset($unassigned)) {
                            if (!count($unassigned)==0){
                                foreach ($unassigned as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';
                                    }
                                    echo '
                                                </ul></div>
                                                <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                <br>
                                                <div class="row">
                                               
                                        <label for="deliveryPersons"><h6 style="color: black">Choose a Delivery Person: </h6></label>';
                                    if ($deliveryPersonsList) {
                                        echo '<div class="col-lg-10 col-sm-5 " style="margin-top: 5px"><select class="delivery_persons " name="deliveryPerson" id="" >';
                                        foreach ($deliveryPersonsList as $dp) {
                                            echo '<option value=' . $dp->getUserId() . '>' . $dp->getFirstName() . '</option>
                                                ';
                                        }


                                        echo '                                        </select></div>
                                        <div class="col-lg-2 col-sm-6 col-md-4" style="margin-top: 5px">
                                    <button style="margin-left: 10px" type="submit" class="btn btn-success " name="assignDeliveryPerson" value=' . $sellerOrder->getOrderId() . '>Add</button>
                                            </div>';
                                    } else {
                                        echo "<div style=\"margin-left:10px; text-align:center;\"><p>Currently you don't have delivery persons assigned to your shop.</p><div><p>Click <a href=\"deliverypersons\" style=\"color: crimson;\">here</a> to add a delivery person to your shop.</p></div></div>";
                                    }
                                            echo '</div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>';
                                }
                            } else { echo '<h6 class="card-title">No Unassigned Orders to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Assigned-->
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-male" style='font-size:24px; margin-right: 5px;'></i>Assigned
                        <?php
                        if (isset($assigned)){
                            if (!count($assigned)==0) { echo '<span class="badge badge-pill badge-success">'.count($assigned).'</span>'; }
                        }
                        ?>
                    </h5>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">

                        <?php
                        if (isset($assigned)) {
                            if (!count($assigned)==0){
                                foreach ($assigned as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';
                                    }
                                    echo '
                                                </ul></div>
                                                <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </form>';
                                }
                            } else { echo '<h6 class="card-title">No Assigned Orders to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--On-delivery-->
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fa fa-truck" style='font-size:24px; margin-right: 5px;'></i>On-Delivery
                        <?php
                        if (isset($ondelivery)){
                            if (!count($ondelivery)==0) { echo '<span class="badge badge-pill badge-success">'.count($ondelivery).'</span>'; }
                        }
                        ?>
                    </h5>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">

                        <?php
                        if (isset($ondelivery)) {
                            if (!count($ondelivery)==0){
                                foreach ($ondelivery as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';
                                    }
                                    echo '
                                                </ul></div>
                                                <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                <br>
                                                
                                            </div>
                                        </div>
                                       </form>
                                    </div>';
                                }
                            } else { echo '<h6 class="card-title">No On-Delivery Orders to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Reported-->
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-exclamation-triangle" style='font-size:24px; margin-right: 5px;'></i>Reported <?php
                        if (isset($reported)){
                            if (!count($reported)==0) { echo '<span class="badge badge-pill badge-success">'.count($reported).'</span>'; }
                        }
                        ?>
                    </h5>
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">
                        <?php
                        if (isset($reported)) {
                            if (!count($reported)==0){
                                foreach ($reported as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                    <div class="col-lg-2 ms-auto">
                                                        <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-lg-6">
                                                    <h6>Order items :- </h6>
                                                    <div class="container"><ul class="list-group list-group-flush">
                                                        ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';
                                    }
                                    echo '
                                                    </ul></div>
                                                    <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h6>Customer Name : '.$sellerOrder->getCustomerName().'</h6>
                                                        <h6>Contact Number : '.$sellerOrder->getCustomerMobileNo().'</h6>
                                                        <br>
                                                        <h6>Delivery Person : '.$sellerOrder->getDpName().'</h6>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>';
                                }
                            } else { echo '<h6 class="card-title">No Rejected Orders to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Confirmed-->
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-check-circle" style='font-size:24px; margin-right: 5px;'></i>Confirmed</h5>
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">

                        <?php
                        if (isset($confirmed)) {
                            if (!count($confirmed)==0){
                                foreach ($confirmed as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';
                                    }
                                    echo '
                                                </ul</div>
                                                <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </form>';
                                }
                            } else { echo '<h6 class="card-title">No Confirmed Orders to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Rejected-->
    <div class="accordion accordion-flush acc" id="accordionFlushExample">
        <div class="accordion-item acc">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                    <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-times-circle" style='font-size:24px; margin-right: 5px;'></i>Rejected</h5>
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="row">
                        <?php
                        if (isset($rejected)) {
                            if (!count($rejected)==0){
                                foreach ($rejected as $sellerOrder) {
                                    echo '<div class="col-lg-6">
                                        <form action="' . WEBROOT . 'sellerOrders' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Order ID : ' . $sellerOrder->getOrderId() . '</h5>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $sellerOrder->getOrderStatus() . '">' . $sellerOrder->getOrderStatus() . '</p>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                    foreach ($orderItemsList[$sellerOrder->getOrderId()] as $orderItem) {
                                        echo '<li>' . $orderItem["shop_item_name"]. ' - ' . quantityToKilogram($orderItem["quantity"]). '</li>';
                                    }
                                    echo '
                                                </ul></div>
                                                <br><h6>Total price = Rs: ' . $sellerOrder->getTotalPrice() . '/=</h6>
                                                <br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    </form>';
                                }
                            } else { echo '<h6 class="card-title">No Rejected Orders to show.</h6>'; }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php
    } else {
    echo "<div style=\"margin-left:10px; text-align:center; margin-top: 20px\"><h4>Currently you have no shop on your own.</h4><div><h5>Want to create a shop?</h5></div><div><p>Click <a href=\"becomeASeller\" style=\"color: crimson;\">here</a> to create your shop now with few easy steps.</p><p>Become a seller in our Online Fresh Market platform to grow your business</p></div></div>";
    }
?>

</div>

<?php
    function quantityToKilogram($quantity){

        $item_amount = "";
        $amount_details = explode(".", "$quantity");


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
                $kilograms = $amount_details[0];
                $item_amount .= "$kilograms" . " kg ";
            }
        }
        return $item_amount;
    }
?>