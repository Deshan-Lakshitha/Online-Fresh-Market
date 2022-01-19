<?php

class HomeController extends Controller
{
    function default()
    {
        $this->index();
    }

    function index() {
        $this->render("home");
    }
}