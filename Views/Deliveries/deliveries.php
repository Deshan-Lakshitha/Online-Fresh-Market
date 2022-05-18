<h2 style="margin-top: 10px; margin-left: 5px; color: #174966; font-family: 'Roboto Slab', serif;">Your Deliveries</h2>
<br>

<?php
if (isset($error)) {
    echo "<p class=\"formError\">Something went wrong. Please try again.</p>";
}
if (isset($success)) {
    switch ($success) {
        case 'success_delivered':
            echo "<p class=\"formSuccess\">Successfully marked as delivered.</p>";
            break;
        case 'success_rejected':
            echo "<p class=\"formSuccess\">Successfully marked as customer rejected.</p>";
            break;
        case 'success_accepted':
            echo "<p class=\"formSuccess\">Successfully marked as accepted.</p>";
            break;
        case 'success_unassigned':
            echo "<p class=\"formSuccess\">Successfully marked as rejected by you.</p>";
            break;
        default:
            break;
    }
}
?>

<div class="accordion accordion-flush acc" id="accordionFlushExample">

    <!--Active Deliveries-->
    <div class="accordion-item acc">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fa fa-truck"
                                                                                  style='font-size:24px; margin-right: 5px;'></i>Active
                    Deliveries
                    <?php
                    if (isset($active)) {
                        if (!count($active) == 0) {
                            echo '<span class="badge badge-pill badge-success">' . count($active) . '</span>';
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
                    if (isset($active)) {
                        if (!count($active) == 0) {
                            foreach ($active as $delivery) {
                                echo '<div class="col-lg-6">
                                       <form action="' . WEBROOT . 'deliveries' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Delivery ID : ' . $delivery->getDeliveryID() . '</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Customer Name : ' . $delivery->getCustomerName() . '</li>
                                                    <li class="list-group-item">Shop Name : ' . $delivery->getShopName() . '</li>
                                                    <li class="list-group-item">Order ID : ' . $delivery->getOrderID() . '</li>
                                                    <li class="list-group-item">Delivery Address : ' . $delivery->getDeliveryAddress() . '</li>
                                                    <li class="list-group-item">Contact Number : ' . $delivery->getMobileNo() . '</li>
                                                </ul>
                                                <input type="hidden" id="delivery_id" name="delivery_id" value=' . $delivery->getDeliveryID() . '>
                                                <input type="hidden" id="order_id" name="order_id" value=' . $delivery->getOrderID() . '>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2"><button type="submit" class="btn btn-success" name="delivered">Delivered</button></div>
                                                    <div class="col-sm-2"><button type="submit" class="btn btn-danger" name="rejected">Rejected</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>';
                            }
                        } else {
                            echo '<h6 class="card-title">No active deliveries to show.</h6>';
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<br>

<div class="accordion accordion-flush acc" id="accordionFlushExample">
    <!--Pending Requests-->
    <div class="accordion-item acc">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-hourglass-half"
                                                                                  style='font-size:24px; margin-right: 5px;'></i>Pending
                    Requests
                    <?php
                    if (isset($pending)) {
                        if (!count($pending) == 0) {
                            echo '<span class="badge badge-pill badge-success">' . count($pending) . '</span>';
                        }
                    }
                    ?>
                </h5>
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">

                <div class="row">
                    <?php
                    if (isset($pending)) {
                        if (!count($pending) == 0) {
                            foreach ($pending as $delivery) {
                                echo '<div class="col-6">
                                        <form action="' . WEBROOT . 'deliveries' . '" method="POST">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Delivery ID : ' . $delivery->getDeliveryID() . '</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Customer Name : ' . $delivery->getCustomerName() . '</li>
                                                    <li class="list-group-item">Shop Name : ' . $delivery->getShopName() . '</li>
                                                    <li class="list-group-item">Order ID : ' . $delivery->getOrderID() . '</li>
                                                    <li class="list-group-item">Delivery Address : ' . $delivery->getDeliveryAddress() . '</li>
                                                    <li class="list-group-item">Contact Number : ' . $delivery->getMobileNo() . '</li>
                                                </ul>
                                                <input type="hidden" id="delivery_id" name="delivery_id" value=' . $delivery->getDeliveryID() . '>
                                                <input type="hidden" id="order_id" name="order_id" value=' . $delivery->getOrderID() . '>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-2"><button type="submit" class="btn btn-success" name="accept">Accept</button></div>
                                                    <div class="col-sm-2"><button type="submit" class="btn btn-danger" name="reject">Rejected</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>';
                            }
                        } else {
                            echo '<h6 class="card-title">No pending delivery requests to show.</h6>';
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<br>

<div class="accordion accordion-flush acc" id="accordionFlushExample">
    <!--Completed Deliveries-->
    <div class="accordion-item acc">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fa fa-check-square"
                                                                                  style='font-size:24px; margin-right: 5px;'></i>Completed
                    Deliveries</h5>
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">

                <div class="row">

                    <?php
                    if (isset($completed)) {
                        if (!count($completed) == 0) {
                            foreach ($completed as $delivery) {
                                if ($delivery->getDeliveryStatus() == 'confirmed') {
                                    $status = "Received by the customer";
                                } else {
                                    $status = "Rejected by the customer";
                                }
                                echo '<div class="col-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> Delivery ID : ' . $delivery->getDeliveryID() . '</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Customer Name : ' . $delivery->getCustomerName() . '</li>
                                                    <li class="list-group-item">Shop Name : ' . $delivery->getShopName() . '</li>
                                                    <li class="list-group-item">Order ID : ' . $delivery->getOrderID() . '</li>
                                                    <li class="list-group-item">Delivery Address : ' . $delivery->getDeliveryAddress() . '</li>
                                                    <li class="list-group-item">Contact Number : ' . $delivery->getMobileNo() . '</li>
                                                </ul>
                                                <div class="col-lg-2 ms-auto">
                                                    <p class="label-' . $delivery->getDeliveryStatus() . '">' . $status . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo '<h6 class="card-title">No completed deliveries to show.</h6>';
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
