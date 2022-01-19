<?php

class Signup
{
    public function insertUserData($data) {
        $values = array($data["first_name"], $data["last_name"], $data["address"], $data["district"], $data["close_town"],  $data["email"], password_hash($data["password"], PASSWORD_DEFAULT), $data["mobile_no"], "customer");
        return Database::insert("users", array("first_name", "last_name", "address", "district", "close_town", "email", "password", "mobile_no", "acc_type"), $values);

    }

    public function checkForExistingEmails($email)
    {
        return Database::retrieve("users", array("user_id"), array("email"), array($email));
    }
}