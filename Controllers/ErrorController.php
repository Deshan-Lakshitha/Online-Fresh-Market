<?php

class ErrorController extends Controller
{
    function default()
    {
        $this->notFound();
    }

    function notFound() {
        //$this->set(["a" => $data]);
        $this->render("notFound");
    }
}