<?php

class LoginController extends Controller
{

    function default()
    {
        $this->login();
    }

    function login()
    {
        $this->layout = "navbar";

        require(ROOT . "Models/Login.php");
        require(ROOT . "Classes/User.php");

        $model = new Login();

        $data = $_POST;
        $this->secure_form($data);

        if (isset($data["submit"])) {
            if (empty($data["email"]) or empty($data["password"])) {
                $this->set(array("error" => "empty_fields"));
                $this->render("login");
            } else {
                $user = $model->getUserData($data["email"]);
                if ($user != null) {
                    if (password_verify($data["password"], $user->getPassword())) {
                        session_start();
                        $_SESSION['user'] = serialize($user);
                        header("Location: shops");
                    } else {
                        $this->set(array("error" => "wrong_password"));
                        $this->render("login");
                    }
                } else{
                    $this->set(array("error" => "wrong_password"));
                    $this->render("login");
                }
            }
        } else {
            $this->render("login");
        }
    }
}
