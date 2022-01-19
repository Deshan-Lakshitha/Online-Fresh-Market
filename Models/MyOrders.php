<?php

class MyOrders extends Model
{
    public function load($user_id)
    {
        require(ROOT . "Classes/Order.php");
        require(ROOT . "Classes/MyOrderFactory.php");

        $res = Database::retrieve("orders", "*", array("user_id", "visibility"), array($user_id,"visible"));
        if (!empty($res[0])) {
            $myOrders = array();
            $i = 0;
            foreach ($res as $r) {
                $shop_name =Database::retrieve("shops",array("shop_name"),array("shop_id"),array($r["shop_id"]))[0]["shop_name"];
                $factory = New MyOrderFactory();
                $myOrders[$i] = $factory->createOrder(array($r["order_id"], $r["order_type"], $r["user_id"], $r["shop_id"], $r["delivery_id"], $r["total_price"], $r["order_status"], $shop_name,"A","B","C"));
//                $myOrders[$i] = new Order($r["order_id"], $r["order_type"], $r["user_id"], $r["shop_id"], $r["delivery_id"], $r["total_price"], $r["order_status"], $shop_name,"A","B","C");
                $i++;
            }
            return $myOrders;
        }
    }

    public function updateMyOrderData($order_id,$column, $values){
        //not completed
        return Database::update_table("orders",$column,$values, "order_id", $order_id);

    }
    public function loadOrderItems($myOrders){
        $orderItemsList= [];
        foreach ($myOrders as $o){
            $order_id = $o->getOrderId();
            $orderItems = Database::retrieve("order_items", array("shop_item_name", "quantity"), array("order_id"), array($order_id));
//            var_dump($orderItems);
            $orderItemsList += [ $order_id => $orderItems];
        }
        return $orderItemsList;
    }

}