<?php

class SignupController extends Controller
{
    private $first_name;
    private $last_name;
    private $address;
    private $district;
    private $close_town;
    private $email;
    private $password;
    private $confirm_password;
    private $mobile_no;
//    private $acc_type = "customer";

    function default()
    {
        $this->signup();
    }

    function signup() {
        $this->layout = "navbar";

        require(ROOT . "Models/Signup.php");

        $model = new Signup();

        $data = $_POST;
        $this->secure_form($data);

        if (isset($data["submit"])) {

            $this->first_name = $data["first_name"];
            $this->last_name = $data["last_name"];
            $this->email = $data["email"];
            $this->mobile_no = $data["mobile_no"];
            $this->password = $data["password"];
            $this->confirm_password = $data["confirm_password"];
            $this->address = $data["address"];
            $this->district = $data["district"];
            $this->close_town = $data["close_town"];

            if ($this->checkEmptyFields()){
                $this->set(array("error"=>"empty_fields"));
                $this->render("signup");
                exit();
            }
            if ($this->checkFieldLengths() == false) {
                $this->set(array("error"=>"field_length_exceeded"));
                $this->render("signup");
                exit();
            }
            if ($this->checkValidUsername() == 0) {
                $this->set(array("error"=>"invalid_names"));
                $this->render("signup");
                exit();
            }
            if ($this->checkValidEmail() == false) {
                $this->set(array("error"=>"invalid_email"));
                $this->render("signup");
                exit();
            }
            if ($this->validateMobileNo() == false) {
                $this->set(array("error"=>"invalid_mobile_no"));
                $this->render("signup");
                exit();
            }
            if ($this->comparePasswords() == false) {
                $this->set(array("error"=>"password_mismatch"));
                $this->render("signup");
                exit();
            }
            if ($this->checkExistingEmail($model) == false) {
                $this->set(array("error"=>"user_exists"));
                $this->render("signup");
                exit();
            }

            $result = $model->insertUserData($data);
            if ($result){
                header("Location: login?signup=success");
            } else{
                $this->set(array("error"=>"database_query_error"));
            }

        } else
            $this->render("signup");
    }

    // For empty inputs
    private function checkEmptyFields() {
        return empty($this->first_name) or empty($this->last_name) or empty($this->email) or empty($this->mobile_no) or empty($this->password) or empty($this->confirm_password) or empty($this->address) or empty($this->district) or empty($this->close_town);
    }

    // Check for field lengths
    public function checkFieldLengths() {
        $field_lengths = array('first_name' => 50, 'last_name' => 100, 'address' => 100 , 'email' => 100, 'password' => 100, 'confirm_password' => 100);
        return !(strlen($this->first_name) > 50 || strlen($this->last_name) > 100 || strlen($this->address) > 100 ||  strlen($this->email) > 100 || strlen($this->password) > 100 || strlen($this->confirm_password) > 100);
    }

    // Valid username check
    public function checkValidUsername() {
        return preg_match("/^[a-zA-Z0-9]*$/", $this->first_name) && preg_match("/^[a-zA-Z0-9]*$/", $this->last_name);
    }

    // Valid email check
    public function checkValidEmail()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // Compare 2 passwords
    public function comparePasswords()
    {
        return $this->password == $this->confirm_password;
    }

    // Validate mobile number
    public function validateMobileNo() {
        $MobileNo = $this->mobile_no;
        return !(strlen($MobileNo) != 10 || substr($MobileNo, 0, 2) != '07');
    }

    // Check for already existing emails
    public function checkExistingEmail($model) {
        $user = $model->checkForExistingEmails($this->email);
        return $user[0]["user_id"] == "";
    }
}