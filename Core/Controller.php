<?php

abstract class Controller
{
    var $vars = [];
    var $layout = "default";

    function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    function render($filename)
    {
        $this->set(array("title" => str_replace("Controller","", get_class($this))));

        extract($this->vars);
        ob_start();
        require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
        $content_for_layout = ob_get_clean();
        $navbar = null;

        if ($this->layout == false)
        {
            $content_for_layout;
        }
        elseif ($this->layout == "navbar")
        {
            require(ROOT . "Views/Layouts/" . $this->layout . '.php');
            $navbar = ob_get_clean();
            require(ROOT . "Views/Layouts/default.php");
        }
        elseif ($this->layout == "default")
        {
            require(ROOT . "Views/Layouts/" . $this->layout . '.php');
        }

        //require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
    }

    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function secure_form($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->secure_input($value);
        }
    }

    //public abstract function default($data);
}