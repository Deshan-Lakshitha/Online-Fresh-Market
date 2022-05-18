<?php

class BecomeASeller {

    function insertShopDetails($shop_name, $address, $district, $close_town, $mobile_no, $user_id, $image, $description) {
        return Database::insert("shops", array("shop_name", "address", "district", "close_town", "mobile_no", "user_id", "image", "description"), array($shop_name, $address, $district, $close_town, $mobile_no, $user_id, $image, $description));
    }

    function updateUser($user_id, $shop_id) {
        return Database::update_table("users", array("acc_type", "shop_id"), array("seller", $shop_id), "user_id", $user_id);
    }

    function getShopId($user_id) {
        return Database::retrieve("shops", "*", array("user_id"), array($user_id));
    }
}
