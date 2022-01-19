<!--Topic-->
<div class="topic">
    <h1 style="margin-top: 20px; margin-left: 5px; color: #174966; font-family: 'Roboto Slab', serif;">My Orders...</h1>
</div>

<!--order items-->

<div class="accordion accordion-flush acc" id="accordionFlushExample">
    <div class="accordion-item acc">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-plus-circle"
                                                                                  style='font-size:24px; margin-right: 5px;'></i>My
                    Orders
                    <?php
                    if (isset($myOrderList)) {
                        if (!count($myOrderList) == 0) {
                            echo '<span class="badge badge-pill badge-success">' . count($myOrderList) . '</span>';
                        }
                    }
                    ?>
                </h5>
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">

                <div class="row">
                    <?php
                    if (isset($myOrderList)) {
                        if (!count($myOrderList) == 0) {
                            foreach ($myOrderList as $myOrder) {
                                echo '<div class="col-lg-6">
                                    <form action="' . WEBROOT . 'myorders' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Order ID : ' . $myOrder->getOrderId() . '</h5>
                                                <div class="row"><div class="col"><h5 style="color: #174966">'. $myOrder->getShopName() .'</h5></div>
                                                <div class="col-lg-2 ms-auto">';
                                switch ($myOrder->getOrderStatus()) {
                                    case 'assigned' :
                                    case 'unassigned' :
                                        $label = 'accepted';
                                        break;
                                    default :
                                        $label = $myOrder->getOrderStatus();
                                        break;
                                }
                                echo '<p class="label-' . $label . '">' . $label . '</p></div>
                                                </div>
                                                <h6>Order items :- </h6>
                                                <div class="container"><ul class="list-group list-group-flush">
                                                    ';
                                foreach ($orderItemsList[$myOrder->getOrderId()] as $orderItem) {
                                    echo '<li>' . $orderItem["shop_item_name"] . ' - ' . quantityToKilogram($orderItem["quantity"]) . '</li>';
                                }
                                echo '<br><h6>Total price = Rs: ' . $myOrder->getTotalPrice() . '/=</h6>
                                                </ul></div>
                                                <br>
                                                <div class="row">';
                                if ($myOrder->getOrderStatus() == 'ondelivery') {
                                    echo '
                    
                                            <div class="rating">
                                            <input type="radio" name="rating" value="5" id="5">
                                            <label for="5">☆</label> <input type="radio" name="rating" value="4" id="4">
                                            <label for="4">☆</label> <input type="radio" name="rating" value="3" id="3">
                                            <label for="3">☆</label> <input type="radio" name="rating" value="2" id="2">
                                            <label for="2">☆</label> <input type="radio" name="rating" value="1" id="1">
                                            <label for="1">☆</label> </div>
                                            ';
                                }
                                echo '<div class="col-lg-6 ms-auto">';
                                switch ($myOrder->getOrderStatus()) {
                                    case 'pending':
                                        echo '<button type="submit" class="btn btn-danger" name="cancel" value=' . $myOrder->getOrderId() . '>Cancel</button>';
                                        break;
                                    case 'ondelivery':
                                        echo '<button type="submit" class="btn btn-secondary" name="confirm" value=' . $myOrder->getOrderId() . '>Confirm</button>
                              <button type="submit" class="btn btn-danger" name="reject" value=' . $myOrder->getOrderId() . '>Reject</button>';
                                        break;
                                    case 'rejected':
                                    case 'confirmed':
                                        echo '<div class="row">
                                                    <div class="col"><button type="submit" class="btn btn-warning" name="close" value=' . $myOrder->getOrderId() . '>Close</button></div>
                                                    <div class="col"><button type="submit" class="btn btn-danger" name="report" value=' . $myOrder->getOrderId() . '>Report</button></div>
                                                </div>';
                                        break;
                                        case 'reported':
                                        echo '<button type="submit" class="btn btn-danger" name="cancel" value=' . $myOrder->getOrderId() . '>Cancel & Close</button>';
                                        break;

                                    default:
                                }
                                $_POST["order_id"] = $myOrder->getOrderId();
                                echo '
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    </div>';
                            }
                        } else {
                            echo '<h6 class="card-title">No Orders to show.</h6>';
                        }
                    } else {
                        echo '<h6 class="card-title">No Orders to show.</h6>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
function quantityToKilogram($quantity)
{

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