<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2FDD92;">
    <div class="container-fluid">
        <?php
            // Generate link for navbar heading and logo
            if ($title == 'Login' || $title == 'Signup')
                $link = 'home';
            else
                $link = 'shops';
        ?>
        <a class="navbar-brand" href="<?= $link ?>" style="font-weight: bold; font-size: x-large; color: #174966; font-family: 'Roboto Slab', serif;">
            <img src="<?= WEBROOT ?>HomeImages/Navbar Logo.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> Online Fresh Market
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <?php
                switch ($title) {
                    case 'Login':
                        require_once ROOT . 'Views/Login/navbar_login.php';
                        break;
                    case 'Signup':
                        require_once ROOT . 'Views/Signup/navbar_signup.php';
                        break;
                    case 'Shops':
                        require_once ROOT . 'Views/Shops/navbar_shops.php';
                        break;
                    case 'Shop':
                        require_once ROOT . 'Views/Shop/navbar_shop.php';
                        break;
                    case 'Profile':
                        require_once ROOT . 'Views/Profile/navbar_profile.php';
                        break;
                    case 'DeliveryPersons':
                        require_once ROOT . 'Views/DeliveryPersons/navbar_delivery_persons.php';
                        break;
                    case 'Myshop':
                        require_once ROOT . 'Views/Myshop/navbar_myshop.php';
                        break;
                    case 'Deliveries':
                        require_once ROOT . 'Views/Deliveries/navbar_deliveries.php';
                        break;
                    case 'SellerOrders':
                        require_once ROOT . 'Views/SellerOrders/navbar_sellerOrders.php';
                        break;
                    case 'MyOrders':
                        require_once ROOT . 'Views/MyOrders/navbar_myOrders.php';
                        break;
                    case 'BecomeASeller':
                        require_once ROOT . 'Views/BecomeASeller/navbar_become_a_seller.php';
                        break;
                }
                ?>

            </ul>

        </div>
    </div>
</nav>
