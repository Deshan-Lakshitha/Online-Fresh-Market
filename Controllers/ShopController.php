<?php

class ShopController extends Controller
{
    function default($shop_id, $data)
    {
        $this->shop($shop_id, $data);
    }

    function shop($shop_id, $data)
    {
        $this->layout = "navbar";

        require(ROOT . "Classes/ShopItem.php");
        require(ROOT . "Classes/OrderItem.php");
        require(ROOT . "Models/ShopModel.php");
        require(ROOT . "Classes/User.php");

        session_start();
        if (!isset($_SESSION["user"])) {
            header("Location: ../login");
        }
        $user = unserialize($_SESSION["user"]);

        $model = new ShopModel();

        //var_dump($_POST);
        $order_item_list = [];

        $order_data = $_POST;
        $this->secure_form($order_data);

        require(ROOT . "Classes/Shop.php");
        $shop = $model->getShop($shop_id);
        $this->set(array("shop" => $shop));

        if (isset($order_data)) {
            unset($order_data["create_order"]);
            for ($i = 0; $i < count($order_data) / 2; $i++) {
                //var_dump($i);
                array_push($order_item_list, new OrderItem($model->getShopItem($order_data["orderShopItemId_$i"]), $order_data["orderShopItemQuantity_$i"]));
            }
        }

        //var_dump($order_item_list);

        $shop_item_list = $model->getShopItemList($shop_id);

        //var_dump($shop_item_list);
        //$shop_item_list = [new ShopItem("0", "A", "250", "2", "in stock", "0", ""), new ShopItem("1", "B", "300", "1", "in stock", "0", "")];

        //var_dump($shop_item_list);

        $this->set(array("shop_id" => $shop_id));

        if ($shop_item_list[0]->item_id == "") {
            $this->set(array("no_items" => true));
            $this->set(array("shop_items" => []));
        } else {
            $this->set(array("shop_items" => $shop_item_list));
        }

        if (isset($_SESSION["cart"])) {
            $cart = unserialize($_SESSION["cart"]);
        } else {
            $cart = [];
        }

        //var_dump($cart);

        if (isset($data["delete"]) and isset($data["item_id"])) {
            //$index_to_remove = "";
            /*for ($i = 0; $i < count($cart); $i++) {
                var_dump($i);
                $order_item = $cart[$i];

                if ($order_item->shop_item->item_id == $data["item_id"]) {
                    var_dump($i);
                    $index_to_remove = $i;
                }
            }
            if (isset($index_to_remove)) {
                var_dump($i);
                unset($cart[$index_to_remove]);
            }*/

            foreach ($cart as $index => $order_item) {
                if ($order_item->shop_item->item_id == $data["item_id"]) {
                    $index_to_remove = $index;
                }
            }
            if (isset($index_to_remove)) {
                unset($cart[$index_to_remove]);
            }

            /*foreach ($cart as $order_item) {
                if ($order_item->shop_item->item_id == $data["item_id"]) {
                    unset($order_item);
                }
            }*/
        }

        if (isset($data["item_id"]) and isset($data["amount"]) and $data["amount"] != "0") {
            //var_dump($shop_item_list);
            foreach ($shop_item_list as $shop_item) {
                if ($shop_item->item_id == $data["item_id"]) {
                    $added = false;
                    foreach ($cart as $order_item) {
                        if ($order_item->shop_item->item_id == $data["item_id"]) {
                            if (($order_item->quantity + (float) $data["amount"]) <= (float) $order_item->shop_item->quantity) {
                                $order_item->quantity += (float) $data["amount"];
                            } else {
                                $this->set(array("stock_exceeded" => $shop_item));
                            }
                            $added = true;
                        }
                    }
                    if (!$added) {
                        if ((float) $data["amount"] <= (float) $shop_item->quantity) {
                            $cart = array_merge($cart, array(new OrderItem($shop_item, (float) $data["amount"])));
                        } else {
                            $this->set(array("stock_exceeded" => $shop_item));
                        }
                    }
                }
            }
        }

        if ($cart != []) {
            $total_price = 0;

            foreach ($cart as $order_item) {
                $total_price += ((float) $order_item->shop_item->unit_price) * $order_item->quantity;
            }

            $this->set(array("total_price" => $total_price));
        }

        if (isset($_POST["create_order"])) {
            if ($order_item_list != []) {
                $status = $model->storeOrder($user->getId(), $shop_id, $total_price, $order_item_list);
                if ($status){
                    unset($_SESSION["cart"]);
                    $cart =  array();
                    header("Location: ../myOrders?order_submit=success");
                }
                else {
                    $this->set(array("order_submit" => "failed"));
                }
            }
        }

        $_SESSION["cart"] = serialize($cart);

        $this->set(array("cart" => $cart));
        //var_dump($_GET);
        //$_SESSION["cart"] = [];

        //session_destroy();

        //session_start();
        //$user = unserialize($_SESSION['user']);

        $this->render("shop");
    }
}
