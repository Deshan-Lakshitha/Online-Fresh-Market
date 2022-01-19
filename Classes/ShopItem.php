<?php

class ShopItem
{
    public $item_id, $item_name, $unit_price, $quantity, $is_available, $shop_id, $image;

    function __construct($item_id, $item_name, $unit_price, $quantity, $is_available, $shop_id, $image) {
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->unit_price = $unit_price;
        $this->quantity = $quantity;
        $this->is_available = $is_available;
        $this->shop_id = $shop_id;
        $this->image = $image;
    }

    public function getItemId()
    {
        return $this->item_id;
    }
    public function getItemName()
    {
        return $this->item_name;
    }
    public function getUnitPrice()
    {
        return $this->unit_price;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getIsAvailable()
    {
        return $this->is_available;
    }
    public function getShopId()
    {
        return $this->shop_id;
    }
    public function getImage()
    {
        return $this->image;
    }

    
}

// class ShopItem
// {
//     public $item_id, $item_name, $unit_price, $available_order, $order_item_id;

//     function __construct($item_id, $item_name, $unit_price, $available_order) {
//         $this->item_id = $item_id;
//         $this->item_name = $item_name;
//         $this->unit_price = $unit_price;
//         $this->available_order = $available_order;
//     }
// }