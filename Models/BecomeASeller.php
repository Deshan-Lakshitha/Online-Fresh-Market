<?php

class BecomeASeller {

    function insertShopDetails($shop_name, $address, $district, $close_town, $mobile_no, $user_id, $image, $description) {
        return Database::insert("shops", array("shop_name", "address", "district", "close_town", "mobile_no", "user_id", "image", "description"), array($shop_name, $address, $district, $close_town, $mobile_no, $user_id, $image, $description));
    }
}
