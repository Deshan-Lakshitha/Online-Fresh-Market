<?php


class Profile
{
    public function updateProfile($columns, $values){

        return Database::update("users", $columns, array("email"), $values);
    }

    public function updatePassword($values){
        return Database::update("users", array("password"), array("email"), $values);
    }

    public function getDeliveryPersonRequest($user_id){
        require(ROOT . "Classes/DeliveryPersonRequest.php");

        $res = Database::retrieve("requests", "*", array("user_id", "status"), array($user_id, "pending"));
        if (!empty($res[0])) {
            $requests = array();
            $i = 0;
            foreach ($res as $r) {
                $shop_data = $this->getShopData($r["shop_id"]);

                $requests[$i] = new DeliveryPersonRequest($r["request_id"], $r["shop_id"], $r["shop_name"], $r["user_id"], $shop_data[0]["address"], $shop_data[0]["mobile_no"]);
                $i++;
            }

            return $requests;
        }
    }

    public function getShopData($shop_id){
        return Database::retrieve("shops", array("address", "mobile_no"), array("shop_id"), array($shop_id));
    }

    public function updateRequest($values){
        return Database::update("requests", array("status"), array("request_id"), $values);
    }

    public function addDeliveryPerson($values){
        return Database::insert("delivery_persons", array("user_id", "first_name", "last_name", "shop_id", "is_deleted"), $values);
    }

    public function updateAccType($user_id){
        return Database::update("users", array("acc_type"), array("user_id"), array("delivery_person", $user_id));
    }
}