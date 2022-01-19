<?php


class SellerOrders extends Model
{
    public function load($shop_id){
        require(ROOT . "Classes/Order.php");
        require(ROOT . "Classes/SellerOrderFactory.php");

        $res = Database::retrieve("orders", "*", array("shop_id", "visibility"), array($shop_id,"visible"));
        if (!empty($res[0])) {
            $sellerOrders = array();
            $i = 0;
            foreach ($res as $r) {
                $shop_name =Database::retrieve("shops",array("shop_name"),array("shop_id"),array($r["shop_id"]))[0]["shop_name"];
                $customer = Database::retrieve("users", "*", array("user_id"), array($r["user_id"]));
                $customer_name = $customer[0]["first_name"] . " " . $customer[0]["last_name"];
                $customer_mobile_no = $customer[0]["mobile_no"];
                $dp_name = "";
                if ($r["delivery_id"]) {
                    $delivery_person_id = Database::retrieve("deliveries", array("delivery_person_id"), array("delivery_id"), array($r["delivery_id"]))[0]["delivery_person_id"];
                    $delivery_person = Database::retrieve("users", "*", array("user_id"), array($delivery_person_id));
                    $dp_name= $delivery_person[0]["first_name"] . " " . $delivery_person[0]["last_name"];
                }

                $factory = new SellerOrderFactory();
                $sellerOrders[$i] = $factory->createOrder(array($r["order_id"], $r["order_type"], $r["user_id"], $r["shop_id"], $r["delivery_id"], $r["total_price"], $r["order_status"], $shop_name, $customer_name, $customer_mobile_no, $dp_name));
//                $sellerOrders[$i] = new Order($r["order_id"], $r["order_type"], $r["user_id"], $r["shop_id"], $r["delivery_id"], $r["total_price"], $r["order_status"], $shop_name, $customer_name, $customer_mobile_no, $dp_name);
                $i++;
            }
            return $sellerOrders;
        }
    }
    public function loadDeliveryPersons($shop_id){
        require(ROOT . "Classes/DeliveryPerson.php");

        $res = Database::retrieve("delivery_persons", "*",array("shop_id","is_deleted"),array($shop_id,0));
        if (!empty($res[0])){
            $deliveryPersons = array();
            $i = 0;
            foreach ($res as $r){
                $deliveryPersons[$i] = new DeliveryPerson($r["id"], $r["user_id"], $r["first_name"], $r["last_name"],$r["shop_id"]);
                $i++;
            }
            return $deliveryPersons;
        }
    }

    public function updateDeliveries($deliveryPersonUserId, $orderId){
//        return Database::insert("deliveries",array("delivery_person_id","delivery_status"), array($deliveryPersonUserId, "assigned") );
        Database::update_table("deliveries", array("delivery_person_id", " delivery_status"), array($deliveryPersonUserId, "assigned"), "order_id", $orderId);
        $delivery_id=$this->getDeliveryId($orderId);
        Database::update_table("orders", array("delivery_id", "order_status"), array($delivery_id, "assigned"), "order_id", $orderId);
    }
    public function updateSellerOrderData($order_id,$column, $values){
        //not completed
        return Database::update_table("orders",$column,$values, "order_id", $order_id);

    }
    public function getDeliveryId($orderId){
        return Database::retrieve("deliveries", "*", array("order_id"), array($orderId))[0]["delivery_id"];
    }
    public function insertDeliveries($orderId){
        Database::insert("deliveries", array("order_id","delivery_status"), array($orderId, "unassigned"));
        Database::update_table("orders", array("order_status"), array("unassigned"), "order_id", $orderId);
    }
    public function loadOrderItems($myOrders){
        $orderItemsList= [];

        if ($myOrders) {
            foreach ($myOrders as $o){
            $order_id = $o->getOrderId();
            $orderItems = Database::retrieve("order_items", array("shop_item_name", "quantity"), array("order_id"), array($order_id));
            $orderItemsList += [ $order_id => $orderItems];
        }
        }
        return $orderItemsList;
    }
    public function loadShop($user_id)
    {
        return Database::retrieve("shops", array("shop_name", "address"), array("user_id"), array($user_id))[0];
    }

}