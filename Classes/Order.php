<?php


class Order
{
//    private $order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name, $customer_name, $customer_mobile_no, $dp_name;
    private $order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name;

    /**
     * @param $order_id
     * @param $order_type
     * @param $user_id
     * @param $shop_id
     * @param $delivery_id
     * @param $total_price
     * @param $order_status
     * @param $shop_name
     */
    public function __construct($order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name)
    {
        $this->order_id = $order_id;
        $this->order_type = $order_type;
        $this->user_id = $user_id;
        $this->shop_id = $shop_id;
        $this->delivery_id = $delivery_id;
        $this->total_price = $total_price;
        $this->order_status = $order_status;
        $this->shop_name = $shop_name;
    }


    /**
     * @return mixed
     */
    public function getShopName()
    {
        return $this->shop_name;
    }


    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->order_type;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shop_id;
    }

    /**
     * @return mixed
     */
    public function getDeliveryId()
    {
        return $this->delivery_id;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }


}