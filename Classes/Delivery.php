<?php


class Delivery
{
    private $delivery_id, $delivery_person_id, $order_id, $delivery_status, $shop_id, $shop_name, $delivery_address, $customer_name, $mobile_no;


    public function __construct($delivery_id, $delivery_person_id, $order_id, $delivery_status, $shop_id, $shop_name, $delivery_address, $customer_name, $mobile_no)
    {
        $this->delivery_id = $delivery_id;
        $this->delivery_person_id = $delivery_person_id;
        $this->order_id = $order_id;
        $this->delivery_status = $delivery_status;
        $this->shop_id = $shop_id;
        $this->shop_name = $shop_name;
        $this->delivery_address = $delivery_address;
        $this->customer_name = $customer_name;
        $this->mobile_no = $mobile_no;
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
    public function getDeliveryPersonId()
    {
        return $this->delivery_person_id;
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
    public function getDeliveryStatus()
    {
        return $this->delivery_status;
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
    public function getShopName()
    {
        return $this->shop_name;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress()
    {
        return $this->delivery_address;
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
    public function getMobileNo()
    {
        return $this->mobile_no;
    }
}