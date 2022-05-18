<?php

class MyOrdersController extends Controller
{
    function default() {
        $this->myOrders();
    }

    function myOrders(){
        $this->layout = "navbar";

        require (ROOT."Models/MyOrders.php");
        require (ROOT."Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new MyOrders();


//        echo $_SERVER["SCRIPT_NAME"];
        if (isset($_POST["cancel"])){
            $model->updateMyOrderData($_POST["cancel"],array("order_status","visibility"),array("cancelled","hidden"));
        }
        if (isset($_POST["confirm"])){
            if (isset($_POST["rating"]))
                $model->updateMyOrderData($_POST["confirm"],array("rating","order_status"),array($_POST["rating"], "confirmed"));
            else
                $model->updateMyOrderData($_POST["confirm"],array("order_status"),array("confirmed"));
        }
        if (isset($_POST["close"])){
            $model->updateMyOrderData($_POST["close"],array("order_status","visibility"),array("closed","hidden"));
        }
        if (isset($_POST["reject"])){
            $orderItems = $model->loadOrder($_POST["reject"]);
            $shopItems = $model->loadShopItems($model->loadOrderData($_POST["reject"])["shop_id"]);

            $shopItemIds = [];
            $newQuantities = [];

            foreach ($orderItems as $orderItem) {
                array_push($shopItemIds, $orderItem["shop_item_id"]);
                array_push($newQuantities, (float) $shopItems[$orderItem["shop_item_id"]]["quantity"] + (float) $orderItem["quantity"]);
            }
            $model->updateShopItems($shopItemIds, $newQuantities);

            $model->updateMyOrderData($_POST["reject"],array("order_status","visibility"),array("rejected_on_delivery","visible"));
        }
        if (isset($_POST["report"])){
            $model->updateMyOrderData($_POST["report"],array("order_status","visibility"),array("reported","visible"));
        }

        $myOrders = $model->load($user->getId());
        if (!isset($myOrders))
            $myOrders = array();
        $orderItemsList = $model->loadOrderItems($myOrders);

        $this->set(["myOrderList" => $myOrders, "orderItemsList" => $orderItemsList] );


        $this->render("myOrders");
    }

}