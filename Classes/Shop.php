<?php

class Shop
{
    private $shop_id, $shop_name, $address, $district, $close_town, $mobile_no, $user_id, $image, $description;

    public function __construct($shop_id, $shop_name, $address, $district, $close_town, $mobile_no, $user_id, $image, $description)
    {
        $this->shop_id = $shop_id;
        $this->shop_name = $shop_name;
        $this->address = $address;
        $this->district = $district;
        $this->close_town = $close_town;
        $this->mobile_no = $mobile_no;
        $this->user_id = $user_id;
        $this->image = $image;
        $this->description = $description;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @return mixed
     */
    public function getCloseTown()
    {
        return $this->close_town;
    }

    /**
     * @return mixed
     */
    public function getMobileNo()
    {
        return $this->mobile_no;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }






}