<?php

class OrderItem
{
    public $shop_item, $quantity;

    function __construct($shop_item, $quantity)
    {
        $this->shop_item = $shop_item;
        $this->quantity = $quantity;
    }
}