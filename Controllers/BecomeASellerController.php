<?php
class BecomeASellerController extends Controller {
	function default() {
		$this->becomeASeller();
	}

	function becomeASeller() {
        $this->layout = "navbar";

        require(ROOT . "Models/BecomeASeller.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new BecomeASeller();
        $formData = ["shop_name" => "", "address" => "", "district" => "", "close_town" => "", "image" => "", "description" => ""];
        $formErr = false;
        $uploadErr = "";

		if (isset($_POST["submit"])) {
            $data = $_POST;
            $this->secure_form($data);

            if (!(empty($data["shop_name"]) or empty($data["address"]) or empty($data["district"]) or empty($data["close_town"]) or empty($data["mobile_no"]))) {
                if ($_FILES["image"]["size"] != 0 and $_FILES["image"]["tmp_name"]) {
                    $formData["image"] = $_FILES["image"]["name"];
                    if (getimagesize($_FILES["image"]["tmp_name"])) {
                        $currDateTime = getdate();
                        $filename = $currDateTime["year"] . $currDateTime["mon"] . $currDateTime["mday"] . $currDateTime["hours"] . $currDateTime["minutes"] . $currDateTime["seconds"] . $data["shop_name"] . "." . strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                        if (!move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "HomeImages/ShopImages/" . $filename)) {
                            $uploadErr = "serverUploadErr";
                        }
                    } else {
                        $uploadErr = "notImage";
                    }
                } else {
                    $uploadErr = "noFile";
                }

                $model->insertShopDetails($data["shop_name"], $data["address"], $data["district"], $data["close_town"], $data["mobile_no"], $user->getId(), $filename, $data["description"]);
            } else {
                $formErr = true;
            }
            $formData = array_merge($formData, $data);
        }

        $this->set(array("uploadErr" => $uploadErr));
        $this->set(array("formData" => $formData));
        $this->set(array("formErr" => $formErr));

        $this->render("becomeASeller");
	}
}
?>