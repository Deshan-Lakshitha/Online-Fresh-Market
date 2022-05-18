<?php

class MyshopController extends Controller
{

    function default()
    {
        $this->myshop();
    }

    function myshop()
    {

        $this->layout = "navbar";

        require(ROOT . "Models/Myshop.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new Myshop();

        $data = $_POST;
        $this->secure_form($data);

        $formData = array("item_name" => "", "quantity" => "", "unit_price" => "");

        if (isset($data["save"])) {
            $this->set(array("data" => $formData));

            $values = array($data["unit_price"], $data["quantity"], $data["is_available"]);
            $res = $model->updateItem($data["item_id"], $values);
            if ($res)
                $this->set(array("update" => "success"));
            else
                $this->set(array("update" => "failed"));
        } else if (isset($data["add"])) {
            $formData = $data;
            $this->set(array("data" => $formData));

            if (!empty($data["item_name"]) && !empty($data["quantity"]) && !empty($data["unit_price"])) {
                if (is_numeric($data["unit_price"]) && is_numeric($data["quantity"])) {
                    $currDateTime = getdate();
                    $filename = $currDateTime["year"] . $currDateTime["mon"] . $currDateTime["mday"] . $currDateTime["hours"] . $currDateTime["minutes"] . $currDateTime["seconds"] . "." . strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                    if ($this->validateImage($data, $filename)) {
                        $values = array($data["item_name"], $data["unit_price"], $data["quantity"], "in stock", $user->getShopId(), $filename);
                        $res = $model->addItem($values);
                        if ($res) {
                            $this->set(array("add_new" => "success"));
                        } else
                            $this->set(array("error" => "failed"));
                    }
                } else
                    $this->set(array("error" => "not_int"));
            } else
                $this->set(array("error" => "empty_fields"));

        }
        $this->set(array("data" => $formData));

        $shop_details = $model->load($user->getId());
        $this->set(array("shop_info" => $shop_details));

        $items = $model->loadItems($user->getShopId());
        $this->set(array("items" => $items));

        $this->render("myshop");
    }

    private function validateImage($data, $filename)
    {
        if ($_FILES["image"]["name"] == "")
            return true;
        else {
            $target_dir = "../HomeImages/items/";   //Target directory
            $target_file = $target_dir . $filename; // Path of file to upload
            $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Check if image file is an actual image or fake image.
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            if ($check == false) {
                $this->set(array("error" => "img_invalid"));
                return false;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $this->set(array("error" => "img_exists"));
                return false;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 5000000) {     // Here size is in bytes
                $this->set(array("error" => "img_large"));
                return false;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $this->set(array("error" => "img_type_error"));
                return false;
            }

            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
                return true;
            else {
                $this->set(array("error" => "img_failed"));
                return false;
            }
        }
    }


}
