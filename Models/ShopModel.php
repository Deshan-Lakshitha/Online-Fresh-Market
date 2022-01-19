<?php

class ShopModel
{
    function getShopItem($item_id) {
        $shop_item = Database::retrieve("shop_items", "*", array("item_id"), array($item_id))[0];

        //var_dump($shop_item);

        return new ShopItem($shop_item["item_id"], $shop_item["item_name"], $shop_item["unit_price"], $shop_item["quantity"], $shop_item["is_available"], $shop_item["shop_id"], $shop_item["image"]);
    }

    function getOrderItem() {

    }

    function getShopItemList($shop_id) {
        $shop_items = Database::retrieve("shop_items", "*", array("shop_id"), array($shop_id));
        $shop_items_list = [];

        if (isset($shop_items[0]["item_id"])) {
            foreach ($shop_items as $shop_item) {
                $shop_items_list = array_merge($shop_items_list, array(new ShopItem($shop_item["item_id"], $shop_item["item_name"], $shop_item["unit_price"], $shop_item["quantity"], $shop_item["is_available"], $shop_item["shop_id"], $shop_item["image"])));
            }
        } else {
            return [new ShopItem("", "", "", "", "", "", "")];
        }

        return $shop_items_list;
    }

    function storeOrder($user_id, $shop_id, $total_price, $order_item_list) {
        //$order_item_ids = "";

        $status = Database::insert("orders", array("user_id", "shop_id", "delivery_id", "total_price", "order_status", "visibility"), array($user_id, $shop_id, "0", $total_price, "pending", "visible"));
        $order_id = Database::getLastInsertedId();

        foreach ($order_item_list as $order_item) {
            Database::insert("order_items", array("shop_item_id", "quantity", "order_id", "shop_item_name"), array($order_item->shop_item->item_id, $order_item->quantity, $order_id, $order_item->shop_item->item_name));
            //$order_item_ids = implode(",", array($order_item_ids, Database::getLastInsertedId()));
        }

        return $status;
    }

    function getShop($shop_id) {
        $shop = Database::retrieve("shops", "*", array("shop_id"), array($shop_id))[0];

        return new Shop($shop_id, $shop["shop_name"], $shop["address"], $shop["district"], $shop["close_town"], $shop["mobile_no"], $shop["user_id"], $shop["image"], $shop["description"]);
    }
}