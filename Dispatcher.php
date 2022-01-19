<?php

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        if (method_exists($this->request->controller . "Controller", $this->request->action)) {
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        } else {
            $this->request->params = array_merge(array($this->request->action), $this->request->params);
            $this->request->action = "default";
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }
    }

    public function loadController()
    {
        if ($this->request->controller == "deliverypersons") {
            $this->request->controller = "DeliveryPersons";
        }

        $name = $this->request->controller . "Controller";
        $file = ROOT . 'Controllers/' . $name . '.php';

        if (file_exists($file)) {
            require($file);
        } else {
            header("Location: " . WEBROOT . "error");
        }

        $controller = new $name();
        return $controller;
    }

}
?>