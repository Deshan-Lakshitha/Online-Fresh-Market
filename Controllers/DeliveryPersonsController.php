<?php

class DeliveryPersonsController extends Controller
{
    function default() {
        $this->delivery_persons();
    }

    function delivery_persons()
    {
        $this->layout = "navbar";

        require(ROOT . "Models/DeliveryPersons.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new DeliveryPersons();

        $data = $_POST;
        $this->secure_form($data);

        if (isset($data['submit'])) {
            $users = $model->searchUsers($data["search"]);
            if (empty($users))
                $this->set(array("user_search" => "empty"));
            else
                $this->set(array("users" => $users));
        } elseif (isset($data['request'])) {
            $res = $model->sendRequest($user->getShopId(), "ABC Food City", $data['user_id']);
            if ($res)
                $this->set(array("req" => "true"));
            else 
                $this->set(array("req" => "flase"));
        } elseif (isset($data['remove'])) {
            if ($model->remove($data['user_id'], $user->getShopId())) {
                if ($model->updateUserType($data['user_id'])) {
                    $this->set(array("delete" => "success"));
                } else
                    $this->set(array("delete" => "error"));
            } else
                $this->set(array("delete" => "error"));
        }

        if ($user->getShopId() != "") {
            $delivery_persons = $model->load($user->getShopId());
            $this->set(array("deliveryPersons" => $delivery_persons));
            
            $pending_users = $model->loadPendingUsers($user->getShopId());
            $this->set(array("pendingUsers" => $pending_users));
        } 
        else
            $this->set(array("no_shop" => "true"));
        

        $this->render("delivery_persons");
    }
}