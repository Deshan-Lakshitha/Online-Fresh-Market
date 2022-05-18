<h1 style="margin-top: 20px; margin-left: 5px; color: #174966; font-family: 'Roboto Slab', serif;">Recommended Shops for You...</h1>

<!-- Shops - As bootstrap cards-->

<div class="container" style="margin-top: 50px;">

    <div class="row">
        <?php
        if (isset($shop_search))
            echo "<div><h4>No results were found while searching.</h4><div><h5>For better search results,</h5></div><div><ul><li>Check spellings of keywords</li><li>Try changing some keywords</li><li>Try more general key words</li></ul></div></div>";
        else {
            if (isset($shopList)) {
                foreach ($shopList as $shop) {
                    $src = WEBROOT . '/HomeImages/ShopImages/' . $shop->getImage();
                    echo '<div class="col-lg-3 col-md-6">
                        <div class="card" style="width: 18rem;">
                        <img src="' . $src . '" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">' . $shop->getShopName() . '</h5>
                            <p class="card-text">' . $shop->getAddress() . '<br>' . $shop->getMobileNo() . '</p>
                            <a href="shop/'.$shop->getShopId().'" class="btn">Visit</a>
                        </div>
                    </div>
                  </div>';
                }
            } else {
                echo "<h4>No recommended shops to display at this moment. Search for your favourite shop.</h4>";
            }
        }
        ?>
    </div>

</div>

<!-- JS for bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

