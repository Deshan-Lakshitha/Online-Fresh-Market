<?php

class ShopsController extends Controller
{
    function default()
    {
        $this->shops();
    }

    function shops()
    {
        $this->layout = "navbar";

        require(ROOT . "Models/Shops.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);


        $model = new Shops();

        $data = $_POST;
        $this->secure_form($data);

        if (isset($data["submit"])) {
            $shops = $model->searchShops($data["search"]);
            if (empty($shops))
                $this->set(array("shop_search" => "empty"));
        } else
//            $shops = $model->loadShops($user->getCloseTown());
            $shops = $model->load($user->getCloseTown());

        $this->set(["shopList" => $shops]);
        $this->render("shops");
    }
}