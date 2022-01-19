<?php

class Deliveries extends Model
{
    public function load($user_id){

        require(ROOT . "Classes/Delivery.php");

        $res = Database::retrieve("deliveries", "*", array("delivery_person_id"), array($user_id));

        if (!empty($res[0])){
            $deliveries = array();
            $i = 0;
            foreach ($res as $r) {
                $shop_id = $this->getShopId($r["order_id"]);
                $customer_id = $this->getUserId($r["order_id"]);

                $shop_name = $this->getShopName($shop_id);
                $user_data = $this->getUserData($customer_id);

                $deliveries[$i] = new Delivery($r["delivery_id"], $r["delivery_person_id"], $r["order_id"], $r["delivery_status"], $shop_id, $shop_name, $user_data["address"], $user_data["first_name"]." ".$user_data["last_name"], $user_data["mobile_no"] );
                $i++;
            }
            return $deliveries;
        }
    }

    public function getShopId($order_id){

        $res = Database::retrieve("orders", array("shop_id"), array("order_id"), array($order_id));
        return $res[0]["shop_id"];
    }

    public function getUserId($order_id){

        $res = Database::retrieve("orders", array("user_id"), array("order_id"), array($order_id));
        return $res[0]["user_id"];
    }

    public function getShopName($shop_id){

        $res = Database::retrieve("shops", array("shop_name"), array("shop_id"), array($shop_id));
        return $res[0]["shop_name"];

    }

    public function getUserData($user_id){

        $res = Database::retrieve("users", array("first_name", "last_name", "address", "mobile_no"), array("user_id"), array($user_id));
        return $res[0];
    }

    public function updateState($data){

        return Database::update("deliveries", array("delivery_status"), array("delivery_id"), $data);
    }

    public function updateOrder($values){
        return Database::update("orders", array("order_status"), array("order_id"), $values);
    }
}