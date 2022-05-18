<?php
class BecomeASellerController extends Controller {

	function default() {
		$this->becomeASeller();
	}

	function becomeASeller() {
        $this->layout = "navbar";

        require(ROOT . "Models/BecomeASeller.php");
        require(ROOT . "Classes/user.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new BecomeASeller();
        $formData = ["shop_name" => "", "address" => "", "district" => "", "close_town" => "", "mobile_no" => "", "image" => "", "description" => ""];
        $formErr = false;
        $uploadErr = "";

		if (isset($_POST["submit"])) {
            $data = $_POST;
            $this->secure_form($data);

            $currDateTime = getdate();
            $filename = $currDateTime["year"] . $currDateTime["mon"] . $currDateTime["mday"] . $currDateTime["hours"] . $currDateTime["minutes"] . $currDateTime["seconds"] . $data["shop_name"] . "." . strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
            $upload = $this->checkImage($_FILES["image"], ROOT."HomeImages/ShopImages/", $filename, 5000000);

            if (!(empty($data["shop_name"]) or empty($data["address"]) or empty($data["district"]) or empty($data["close_town"]) or empty($data["mobile_no"])) and $upload === true) {
                if ($this->validateMobileNo($data["mobile_no"])) {
                    $this->set(array("mobile_num_error"=>false));
                    $res = $model->insertShopDetails($data["shop_name"], $data["address"], $data["district"], $data["close_town"], $data["mobile_no"], $user->getId(), $filename, $data["description"]);
                    $shop_id = $model->getShopId($user->getId())[0]["shop_id"];
                    $res = $model->updateUser($user->getId(), $shop_id);
                    $user->setShopId($shop_id);
                    $_SESSION['user'] = serialize($user);
                    header("Location: myshop");
                } else
                    $this->set(array("mobile_num_error"=>true));
            } else {
                if ($upload === true) {
                    $uploadErr = "";
                } else {
                    $uploadErr = $upload;
                }
                $formErr = true;
            }
            $formData = array_merge($formData, $data);
        }

        $this->set(array("uploadErr" => $uploadErr));
        $this->set(array("formData" => $formData));
        $this->set(array("formErr" => $formErr));

        $this->render("becomeASeller");
	}

    public function validateMobileNo($MobileNo) {
        $not_numbers = true;
        if (preg_match("/^[0-9]*$/", $MobileNo))
            $not_numbers = false;

        return !(strlen($MobileNo) != 10 || substr($MobileNo, 0, 1) != '0' || $not_numbers);
    }

    function checkImage($image, $directory, $filename, $size_limit)
    {
        if (!isset($image))
            return true;
        else {
            $target_dir = $directory;   //Target directory
            $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Check if image file is an actual image or fake image.
            $target_file = $target_dir . $filename; // Path of file to upload
            // basename($_FILES["file"]["name"]) gets the name as uploaded file name

            if (empty($image["name"])) {
                return "img_no_file";
            }

            $check = getimagesize($image["tmp_name"]);

            if ($check == false) {
                return "img_invalid";
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                return "img_exists";
            }

            // Check file size
            if ($image["size"] > $size_limit) {     // Here size is in bytes
                return "img_large";
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                return "img_type_error";
            }

            // if everything is ok, try to upload file
            if (move_uploaded_file($image["tmp_name"], $target_file))
                return true;
            else {
                return "img_failed";
            }
        }
    }}
?>