<?php

class User
{
    private $id, $first_name, $last_name, $address, $email, $password, $close_town, $mobile_no, $district, $acc_type, $shop_id;

    public function __construct($id, $first_name, $last_name, $address, $email, $password, $close_town, $mobile_no, $district, $acc_type, $shop_id)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->email = $email;
        $this->password = $password;
        $this->close_town = $close_town;
        $this->mobile_no = $mobile_no;
        $this->district = $district;
        $this->acc_type = $acc_type;
        $this->shop_id = $shop_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCloseTown()
    {
        return $this->close_town;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getMobileNo()
    {
        return $this->mobile_no;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function getAccType()
    {
        return $this->acc_type;
    }

    public function getShopId()
    {
        return $this->shop_id;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setCloseTown($close_town): void
    {
        $this->close_town = $close_town;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setDistrict($district): void
    {
        $this->district = $district;
    }

    public function setMobileNo($mobile_no): void
    {
        $this->mobile_no = $mobile_no;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function setAccType($acc_type): void
    {
        $this->acc_type = $acc_type;
    }

    public function setShopId($shop_id): void
    {
        $this->shop_id = $shop_id;
    }
}