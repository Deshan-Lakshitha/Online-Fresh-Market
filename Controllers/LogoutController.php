<?php

class LogoutController extends Controller{

    function default()
    {
        $this->logout();
    }

    function logout()
    {
        $this->render("logout");
    }
}