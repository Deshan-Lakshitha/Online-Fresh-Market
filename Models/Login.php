<?php

class Login
{
    function getUserData($email) {

        $res = Database::retrieve("users", "*", array("email"), array($email));
        if (!$res[0] == array())
            return new User($res[0]["user_id"], $res[0]["first_name"], $res[0]["last_name"], $res[0]["address"],$res[0]["email"], $res[0]["password"], $res[0]["close_town"], $res[0]["mobile_no"], $res[0]["district"], $res[0]["acc_type"], $res[0]["shop_id"]);
    }
}