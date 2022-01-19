<?php

class Shops extends Model
{
    public function load($close_town)
    {
        require(ROOT . "Classes/Shop.php");

        $res = Database::retrieve("shops", "*", array("close_town"), array($close_town));
        return $this->generateShopList($res);
    }

    public function searchShops($search)
    {
        require(ROOT . "Classes/Shop.php");

        $res = Database::search("shops", "shop_name", $search);
        return $this->generateShopList($res);
    }

    /**
     * @param $res
     * @return array|void
     */
    public function generateShopList($res)
    {
        if (!empty($res[0])) {
            $shops = array();
            $i = 0;
            foreach ($res as $r) {
                $shops[$i] = new Shop($r["shop_id"], $r["shop_name"], $r["address"], $r["district"], $r["close_town"], $r["mobile_no"], $r["user_id"], $r["image"], $r["description"]);
                $i++;
            }
            return $shops;
        }
    }

}