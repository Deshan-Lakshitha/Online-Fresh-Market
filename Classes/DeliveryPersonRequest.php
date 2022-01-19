<?php


class DeliveryPersonRequest
{
    private $request_id, $shop_id, $shop_name, $user_id, $address, $mobile_no;

    public function __construct($request_id, $shop_id, $shop_name, $user_id, $address, $mobile_no)
    {
        $this->request_id = $request_id;
        $this->shop_id = $shop_id;
        $this->shop_name = $shop_name;
        $this->user_id = $user_id;
        $this->address = $address;
        $this->mobile_no = $mobile_no;
    }


    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->request_id;
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getMobileNo()
    {
        return $this->mobile_no;
    }
}