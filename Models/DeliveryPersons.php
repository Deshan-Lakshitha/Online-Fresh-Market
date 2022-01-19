<?php

class DeliveryPersons extends Model
{
    public function load($shop_id)
    {
        $res = Database::retrieve("delivery_persons", "*", array("shop_id", "is_deleted"), array($shop_id, 0));
        return $this->generateUserList($res);
    }

    public function searchUsers($search)
    {
        $res = Database::search("users", "first_name", $search);
        if (!empty($res[0])) {
            $users = array();
            $i = 0;
            foreach ($res as $r) {
                $users[$i] = new User($r["user_id"], $r["first_name"], $r["last_name"], $r["address"],$r["email"], $r["password"], $r["close_town"], $r["mobile_no"], $res[0]["district"], $res[0]["acc_type"], $res[0]["shop_id"]);
                $i++;
            }
            return $users;
        }
    }

    public function sendRequest($shop_id, $shop_name, $user_id)         
    {
        return Database::insert("requests", array("shop_id", "shop_name", "user_id", "status"), array($shop_id, $shop_name, $user_id, "pending"));
    }

    public function loadPendingUsers($shop_id)
    {
        $res = Database::retrieve("requests", "*", array("shop_id", "status"), array($shop_id, "pending"));
        return $this->generateUserList($res);
    }

    public function remove($user_id, $shop_id)        
    {
        return Database::update_table_multiple("delivery_persons", array("is_deleted"), array(1), array("user_id", "shop_id"), array($user_id, $shop_id));
    }

    public function updateUserType($user_id)
    {
        return Database::update_table("users", array("acc_type"), array("customer"), "user_id", $user_id);
    }

    private function generateUserList($res)
    {
        if (!empty($res[0])) {
            $users = array();
            $i = 0;
            foreach ($res as $result) {
                $r = Database::retrieve("users", "*", array("user_id"), array($result["user_id"]))[0];
                $users[$i] = new User($r["user_id"], $r["first_name"], $r["last_name"], $r["address"],$r["email"], $r["password"], $r["close_town"], $r["mobile_no"], $r["district"], $r["acc_type"], $r["shop_id"]);
                $i++;
            }
            return $users;
        }
    }

}
