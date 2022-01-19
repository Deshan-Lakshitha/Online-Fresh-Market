<?php

class MyOrder extends Order
{

    public function __construct($order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name)
    {
        parent::__construct($order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name);
    }
}