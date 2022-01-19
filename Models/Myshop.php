<?php

class Myshop extends Model {

    public function load($user_id)
    {
        return Database::retrieve("shops", array("shop_name", "address"), array("user_id"), array($user_id))[0];
    }

    public function loadItems($shop_id)
    {
        $res = Database::retrieve("shop_items", "*", array("shop_id"), array($shop_id));
        return $this->generateItemList($res);
    }

    public function updateItem($item_id, $values)
    {
        return Database::update_table("shop_items", array("unit_price", "quantity", "is_available"), $values, "item_id", $item_id);
    }

    public function addItem($values)
    {
        return Database::insert("shop_items", array("item_name", "unit_price", "quantity", "is_available", "shop_id", "image"), $values);
    }

    private function generateItemList($res)
    {   
        require(ROOT . "Classes/ShopItem.php");

        if (!empty($res[0])) {
            $items = array();
            $i = 0;
            foreach ($res as $r) {
                $items[$i] = new ShopItem($r['item_id'], $r['item_name'], $r['unit_price'], $r['quantity'], $r['is_available'], $r['shop_id'], $r['image']);
                $i++;
            }
            return $items;
        }
    }

}