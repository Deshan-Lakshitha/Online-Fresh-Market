<?php

class SellerOrder extends Order
{
    private $customer_name, $customer_mobile_no, $dp_name;

    /**
     * @param $customer_name
     * @param $customer_mobile_no
     * @param $dp_name
     */
    public function __construct($order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name, $customer_name, $customer_mobile_no, $dp_name)
    {
        parent::__construct($order_id, $order_type, $user_id, $shop_id, $delivery_id, $total_price, $order_status, $shop_name);
        $this->customer_name = $customer_name;
        $this->customer_mobile_no = $customer_mobile_no;
        $this->dp_name = $dp_name;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customer_name;
    }

    /**
     * @return mixed
     */
    public function getCustomerMobileNo()
    {
        return $this->customer_mobile_no;
    }

    /**
     * @return mixed
     */
    public function getDpName()
    {
        return $this->dp_name;
    }



}