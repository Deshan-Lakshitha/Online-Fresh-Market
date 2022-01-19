<?php


class DeliveryPerson
{
    private $id, $user_id, $first_name, $last_name, $shop_id;

    /**
     * DeliveryPerson constructor.
     * @param $id
     * @param $user_id
     * @param $first_name
     * @param $last_name
     * @param $shop_id
     * @param $is_deleted
     */
    public function __construct($id, $user_id, $first_name, $last_name, $shop_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->shop_id = $shop_id;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shop_id;
    }


}