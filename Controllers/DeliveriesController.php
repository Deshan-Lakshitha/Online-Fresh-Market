<?php


class DeliveriesController extends Controller
{
    function default()
    {
        $this->deliveries();
    }

    function deliveries()
    {

        $this->layout = "navbar";

        require(ROOT . "Models/Deliveries.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new Deliveries();
        $user_id = $user->getId();

        $data = $_POST;
        $this->secure_form($data);

        if (isset($data["delivered"])) {
            $values = array();
            array_push($values, "confirmed");
            array_push($values, $data["delivery_id"]);
            if ($model->updateState($values)) {
                $order_values = array("confirmed", $data["order_id"]);
                if ($model->updateOrder($order_values)) {
                    $this->set(array("success" => "success_delivered"));
                } else {
                    $this->set(array("error" => "error"));
                }
            } else {
                $this->set(array("error" => "error"));
            }
        } elseif (isset($data["rejected"])) {
            $values = array();
            array_push($values, "rejected");
            array_push($values, $data["delivery_id"]);
            if ($model->updateState($values)) {
                $order_values = array("rejected", $data["order_id"]);
                if ($model->updateOrder($order_values)) {
                    $this->set(array("success" => "success_rejected"));
                } else {
                    $this->set(array("error" => "error"));
                }
            } else {
                $this->set(array("error" => "error"));
            }
        } elseif (isset($data["accept"])) {
            $values = array();
            array_push($values, "accepted");
            array_push($values, $data["delivery_id"]);
            if ($model->updateState($values)) {
                $order_values = array("ondelivery", $data["order_id"]);
                if ($model->updateOrder($order_values)) {
                    $this->set(array("success" => "success_accepted"));
                } else {
                    $this->set(array("error" => "error"));
                }
            } else {
                $this->set(array("error" => "error"));
            }
        } elseif (isset($data["reject"])) {
            $values = array();
            array_push($values, "unassigned");
            array_push($values, NULL);
            array_push($values, $data["delivery_id"]);
            if ($model->updateRejectState($values)) {
                $order_values = array("unassigned", $data["order_id"]);
                if ($model->updateOrder($order_values)) {
                    $this->set(array("success" => "success_unassigned"));
                } else {
                    $this->set(array("error" => "error"));
                }
            } else {
                $this->set(array("error" => "error"));
            }
        }
        $deliveries = $model->load($user_id);
        $this->seperatelist($deliveries);

        $this->render("deliveries");
    }

    function seperatelist($deliveries)
    {
        $active = array();
        $pending = array();
        $completed = array();

        if ($deliveries) {
            foreach ($deliveries as $delivery) {
                $status = $delivery->getDeliveryStatus();
                switch ($status) {
                    case 'accepted':
                        array_push($active, $delivery);
                        break;
                    case 'assigned':
                        array_push($pending, $delivery);
                        break;
                    case 'confirmed':
                    case 'rejected':
                        array_push($completed, $delivery);
                        break;
                }
            }
        }
        $this->set(["active" => $active, "pending" => $pending, "completed" => $completed]);
    }
}
