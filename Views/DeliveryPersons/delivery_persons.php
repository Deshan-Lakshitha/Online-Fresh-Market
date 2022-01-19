<h1 style="margin-top: 20px; margin-left: 5px; color: #174966; font-family: 'Roboto Slab', serif;">Delivery Persons</h1>

<?php

if (isset($delete))
    switch ($delete){
        case "error":
            echo "<p class=\"req_error\">Removing delivery person failed. Try again.</p>";
            break;
        case "success":
            echo "<p class=\"req_success\">Delivery person was removed successfully.</p>";
            break;
    }

if (!isset($no_shop)) {

?>

    <?php if (isset($deliveryPersons)) { ?>
        <table class="table table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile Number</th>
                <th></th>
                </th>
            </tr>
        <?php foreach ($deliveryPersons as $deliveryPerson) {
            echo '<tr><td>' . $deliveryPerson->getFirstName() . ' ' . $deliveryPerson->getLastName() . '</td><td>' . $deliveryPerson->getAddress() . '</td><td>' . $deliveryPerson->getMobileNo() . '</td>
            <td><form class="d-flex reqForm" action="' . WEBROOT . 'deliverypersons' . '" method="post">
                <input type="hidden" name="user_id" value="' . $deliveryPerson->getId() . '">
                <button class="btn btn-danger remove" type="submit" name="remove" style="color: white;" onclick="return confirm(\'Are you sure you want to delete this delivery person from your shop? This cannot be undone.\');"><i class="fas fa-trash" style="font-size:24px; color:black;"></i></button>
            </form></td>

            </tr>';
        }
    }

    else
        echo "<div style=\"margin-left:10px; text-align:center;\"><h4>Currently you don't have delivery persons assigned to your shop.</h4><div><p>We recommend you to add at least one delivey person to continue your business in this platform.</p></div></div>";
        ?>
        </table>


        <!--Requesting for a delivery person-->
        <div class="accordion accordion-flush acc" id="accordionFlushExample">
            <div class="accordion-item acc">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class='fas fa-user-plus' style='font-size:24px; margin-right: 5px;'></i>Add a new delivery person</h5>
                    </button>
                </h2>

                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <?php
                        if (isset($req)) {
                            if ($req)
                                echo "<p class=\"req_success\">Request sent successfully  </p>";
                            else
                                echo "<p class=\"req_error\">Error sending request. Please try agin</p>";
                        }
                        ?>
                        <h6>Send a request for a user to become a delivery person of your shop.</h6>
                        <form class="d-flex reqForm" action="<?php echo WEBROOT . 'deliverypersons'; ?>" method="post">
                            <input class="form-control me-2 search_input" type="search" name="search" placeholder="Search a user by the first name. Ex:Kamal" aria-label="Search">
                            <button class="btn btn-dark" type="submit" name="submit" style="color: white;">Search</button>
                        </form>

                        <div class="row">
                            <?php
                            if (isset($user_search))
                                echo "<div><h4>No results were found while searching.</h4><div><h5>For better search results,</h5></div><div><ul><li>Check spellings of keywords</li><li>Try changing some keywords</li><li>Try more general key words</li></ul></div></div>";
                            else {
                                if (isset($users)) {
                                    foreach ($users as $user) {
                                        echo
                                        '<div class="col-3">
                            <div class="card" style="width: 18rem;">
                            <div class="card-body">
                            <h5 class="card-title">' . $user->getFirstName() . ' ' . $user->getLastName() . '</h5>
                            <p class="card-text">' . $user->getAddress() . '</p>
                            <form class="d-flex reqForm" action="' . WEBROOT . 'deliverypersons' . '" method="post">
                                <input type="hidden" name="user_id" value="' . $user->getId() . '">
                                <button class="btn btn-dark" type="submit" name="request" style="color: white;">Send Request</button>
                            </form>
                            </div>
                            </div>
                        </div>';
                                    }
                                }
                            }
                            ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!--Pending requests-->
        <div class="accordion accordion-flush acc" id="accordionFlushExample">
            <div class="accordion-item acc">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <h5 style="color: #174966; font-family: 'Roboto Slab', serif;"><i class="fas fa-hourglass-half" style='font-size:24px; margin-right: 5px;'></i>Pending Requests</h5>
                    </button>
                </h2>

                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Mobile Number</th>
                                </th>
                            </tr>
                            <?php
                            if (isset($pendingUsers)) {
                                foreach ($pendingUsers as $usr) {
                                    echo '<tr><td>' . $usr->getFirstName() . ' ' . $usr->getLastName() . '</td><td>' . $usr->getAddress() . '</td><td>' . $usr->getMobileNo() . '</td></tr>';
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    <?php
} else
    echo "<div style=\"margin-left:10px; text-align:center;\"><h4>Currently you have no shop on your own.</h4><div><h5>Want to create a shop?</h5></div><div><p>Click <a href=\"becomeASeller\" style=\"color: crimson;\">here</a> to create your shop now with few easy steps.</p><p>Become a seller in our Online Fresh Market platform to grow your business</p></div></div>";
    ?>