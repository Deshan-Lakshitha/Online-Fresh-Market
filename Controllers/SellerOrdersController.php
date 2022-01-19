<?php


class SellerOrdersController extends Controller
{   
    function default() {
        $this->sellerOrders();
    }

    function sellerOrders()
    {
        $this->layout = "navbar";

        require(ROOT . "Models/SellerOrders.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new SellerOrders();


        if (isset($_POST["accept"])){
//            $deliveryPersonUserId = $_POST["deliveryPerson"];
            $orderId = $_POST["accept"];
//            $model->updateDeliveries($deliveryPersonUserId, $orderId);
//            $deliveryId = $model->getDeliveryId($orderId);
//            $model->updateSellerOrderData($orderId, array("delivery_id", "order_status"), array($deliveryId, "assigned"));
            $model->insertDeliveries($orderId);


        }
        if (isset($_POST["reject"])){
            $orderId = $_POST["reject"];
            $model->updateSellerOrderData($orderId, array("order_status"), array("rejected"));
        }
        if (isset($_POST["assignDeliveryPerson"])){
            $deliveryPersonUserId = $_POST["deliveryPerson"];
            $orderId = $_POST["assignDeliveryPerson"];
            $model->updateDeliveries($deliveryPersonUserId, $orderId);
        }

        $shopDetails = $model->loadShop($user->getId());
        if ($shopDetails["shop_name"] != "")
            $this->set(array("shopDetails" => $shopDetails));

        $sellerOrders = $model->load($user->getShopId());
        $deliveryPersons = $model->loadDeliveryPersons($user->getShopId());
        $orderItemsList = $model->loadOrderItems($sellerOrders);

        $this->seperatelist($sellerOrders);

        $this->set(["deliveryPersonsList" => $deliveryPersons, "orderItemsList" => $orderItemsList]);
        $this->render("sellerOrders");
    }

    function seperatelist($orders)
    {
        $pending = array();
        $unassigned = array();
        $assigned = array();
        $ondelivery = array();
        $confirmed = array();
        $rejected = array();
        $reported = array();

        if ($orders) {
            foreach ($orders as $order) {
                $status = $order->getOrderStatus();
                switch ($status) {
                    case 'pending':
                        array_push($pending, $order);
                        break;
                    case 'unassigned':
                        array_push($unassigned, $order);
                        break;
                    case 'assigned':
                        array_push($assigned, $order);
                        break;
                    case 'ondelivery':
                        array_push($ondelivery, $order);
                        break;
                    case 'confirmed':
                        array_push($confirmed, $order);
                        break;
                    case 'rejected':
                        array_push($rejected, $order);
                        break;
                    case 'reported':
                        array_push($reported, $order);
                        break;
                }
            }
        }
        $this->set(["pending" => $pending, "unassigned" => $unassigned, "assigned" => $assigned, "ondelivery" => $ondelivery, "confirmed" => $confirmed, "rejected" => $rejected, "reported" => $reported]);
    }
}