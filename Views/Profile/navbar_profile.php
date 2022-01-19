<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="myOrders" style="font-size: large;">Orders</a>
</li>

<?php
if (isset($user)) {
    switch($user->getAccType()) {
        case 'seller' :
            echo '<a class="nav-link active" aria-current="page" href="myshop" style="font-size: large;">My Shop</a>';
            break;
        case 'delivery_person' :
            echo '<a class="nav-link active" aria-current="page" href="deliveries" style="font-size: large;">Deliveries</a>';
            break;
    }
}
?>

<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="shops" style="font-size: large;">Shops</a>
</li>
