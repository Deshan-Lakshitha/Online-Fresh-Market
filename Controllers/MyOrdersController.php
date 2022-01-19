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
            $model->updateMyOrderData($_POST["confirm"],array("rating","order_status"),array($_POST["rating"], "confirmed"));
        }
        if (isset($_POST["close"])){
            $model->updateMyOrderData($_POST["close"],array("order_status","visibility"),array("closed","hidden"));
        }
        if (isset($_POST["reject"])){
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