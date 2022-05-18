<?php

class ProfileController extends Controller
{
    private $first_name;
    private $last_name;
    private $address;
    private $district;
    private $close_town;
    private $email;
    private $password;
    private $mobile_no;
    private $new_password;
    private $c_new_password;

    function default()
    {
        $this->profile();
    }

    function profile()
    {

        $this->layout = "navbar";

        require(ROOT . "Models/Profile.php");
        require(ROOT . "Classes/User.php");

        session_start();
        require_once("../Includes/check_login.php");
        $user = unserialize($_SESSION['user']);

        $model = new Profile();
        $data = $_POST;
        $this->secure_form($data);

        $this->set(["user" => $user]);

        //       $requests = $model->getDeliveryPersonRequest($user->getId());
        //       $this->set(["requests" => $requests]);

        $formData = array("new_first_name" => "", "new_last_name" => "", "new_mobile_no" => "", "new_address" => "");

        if (isset($data["submit"])) {

            $formData = $data;
            $this->set(array("data" => $formData));

            $this->first_name = $data["new_first_name"];
            $this->last_name = $data["new_last_name"];
            $this->mobile_no = $data["new_mobile_no"];
            $this->password = $data["password"];
            $this->address = $data["new_address"];
            $this->district = $data["new_district"];
            $this->close_town = $data["new_close_town"];

            $columns = array(); //columns need to be updated
            $values = array(); //updated values

            if (!$this->checkPassword($this->password, $user->getPassword())) {
                $this->set(array("error_profile" => "wrong_password"));
            } else if (!$this->checkFieldLengths()) {
                $this->set(array("error_profile" => "field_length_exceeded"));
            } else if ($this->checkValidUsername() == 0) {
                $this->set(array("error_profile" => "invalid_names"));
            } else {
                if (!empty($this->first_name)) {
                    array_push($columns, "first_name");
                    array_push($values, $this->first_name);
                    $user->setFirstName($this->first_name);
                }

                if (!empty($this->last_name)) {
                    array_push($columns, "last_name");
                    array_push($values, $this->last_name);
                    $user->setLastName($this->last_name);
                }

                if (!empty($this->mobile_no)) {
                    if (!$this->validateMobileNo()) {
                        $this->set(array("error_profile" => "invalid_mobile_no"));
                        $this->render("profile");
                        exit();
                    }
                    array_push($columns, "mobile_no");
                    array_push($values, $this->mobile_no);
                    $user->setMobileNo($this->mobile_no);
                }

                if (!empty($this->address)) {
                    array_push($columns, "address");
                    array_push($values, $this->address);
                    $user->setAddress($this->address);
                }

                if (!empty($this->close_town)) {
                    array_push($columns, "close_town");
                    array_push($values, $this->close_town);
                    $user->setCloseTown($this->close_town);
                }

                if (!empty($this->district)) {
                    array_push($columns, "district");
                    array_push($values, $this->district);
                    $user->setDistrict($this->district);
                }

                array_push($values, $user->getEmail());

                $result = $model->updateProfile($columns, $values);
                if ($result) {
                    $_SESSION['user'] = serialize($user);
                    $this->set(array("success_profile" => "profile"));
                } else {
                    $this->set(array("error_profile" => "database_query_error"));
                }
            }
        } elseif (isset($data["password_submit"])) {

            $this->set(array("data" => $formData));

            $this->password = $data["password"];
            $this->new_password = $data["new_password"];
            $this->c_new_password = $data["c_new_password"];

            if (!$this->checkPassword($this->password, $user->getPassword())) {
                $this->set(array("error_password" => "wrong_password"));
            } else if (!$this->comparePasswords()) {
                $this->set(array("error_password" => "password_mismatch"));
            } else if ($this->checkEmptyFields()){
                $this->set(array("error_password" => "empty_password"));
            }
            else {
                $result = $model->updatePassword(array(password_hash($this->new_password, PASSWORD_DEFAULT), $user->getEmail()));
                if ($result) {
                    $user->setPassword(password_hash($this->new_password, PASSWORD_DEFAULT));
                    $_SESSION['user'] = serialize($user);
                    $this->set(array("success_password" => "password"));
                } else {
                    $this->set(array("error_password" => "database_query_error"));
                }
            }
        } elseif (isset($data["accept"])) {

            $this->set(array("data" => $formData));

            if ($model->updateRequest(array("accepted", $data["request_id"]))) {

                $values = array($user->getId(), $user->getFirstName(), $user->getLastName(), $data["shop_id"], '0');
                if ($model->addDeliveryPerson($values)) {

                    if ($model->updateAccType($user->GetId())) {
                        $user->setAccType("delivery_person");
                        $_SESSION['user'] = serialize($user);
                        $this->set(array("success" => "request_accept"));
                    } else {
                        $this->set(array("error_req" => "database_query_error"));
                    }
                } else {
                    $this->set(array("error_req" => "database_query_error"));
                }
            } else {
                $this->set(array("error_req" => "database_query_error"));
            }
        } elseif (isset($data["reject"])) {

            $this->set(array("data" => $formData));

            if (!$model->updateRequest(array("rejected", $data["request_id"]))) {
                $this->set(array("error_req" => "database_query_error"));
            } else {
                $this->set(array("success" => "request_reject"));
            }
        }

        $this->set(array("data" => $formData));

        $requests = $model->getDeliveryPersonRequest($user->getId());
        $this->set(["requests" => $requests]);

        $this->render("profile");
    }

    // Check for field lengths
    public function checkFieldLengths()
    {
        $field_lengths = array('first_name' => 50, 'last_name' => 100, 'address' => 100, 'email' => 100, 'password' => 100);
        return !(strlen($this->first_name) > 50 || strlen($this->last_name) > 100 || strlen($this->address) > 100 ||  strlen($this->email) > 100 || strlen($this->password) > 100);
    }

    // Valid username check
    public function checkValidUsername()
    {
        return preg_match("/^[a-zA-Z0-9]*$/", $this->first_name) && preg_match("/^[a-zA-Z0-9]*$/", $this->last_name);
    }

    // Validate mobile number
    public function validateMobileNo() {
        $MobileNo = $this->mobile_no;
        $not_numbers = true;
        if (preg_match("/^[0-9]*$/", $MobileNo))
            $not_numbers = false;

        return !(strlen($MobileNo) != 10 || substr($MobileNo, 0, 1) != '0' || $not_numbers);
    }

    public function checkPassword($entered_password, $password)
    {
        return password_verify($entered_password, $password);
    }

    public function comparePasswords()
    {
        return $this->new_password == $this->c_new_password;
    }

    // For empty inputs
    private function checkEmptyFields() {
        return empty($this->new_password) or empty($this->c_new_password);
    }
}
