<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);

        if ($url == "/edsa-WebApp_0/")
        {
            $request->controller = "Home";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode("?", $url);

            if (isset($explode_url[1])) {
                $args = $explode_url[1];
            } else {
                $args = "";
            }

            $args = self::processArgs($args);

            $explode_url = explode("/", $explode_url[0]);
            $explode_url = array_slice($explode_url, 2);

            if (isset($explode_url[0]) and isset($explode_url[1])) {
                $request->controller = ucfirst($explode_url[0]);
                $request->action = $explode_url[1];
                $request->params = array($args);
                //$request->params = [];
            } elseif (isset($explode_url[0])) {
                $request->controller = ucfirst($explode_url[0]);
                $request->action = "default";
                $request->params = array($args);
                //$request->params = [];
            } else {
                header("Location: " . WEBROOT . "error");
            }
        }
    }

    static function processArgs($args) {
        $argArray = explode("&", $args);
        $tempArgArray = [];

        foreach ($argArray as $arg) {
            $tempArgArray = array_merge($tempArgArray, self::processArg($arg));
            //var_dump($tempArgArray);
        }

        //var_dump($tempArgArray);
        return $tempArgArray;
    }

    static function processArg($arg) {
        $tempArg = explode("=", $arg);

        if (!isset($tempArg[1])) {
            $tempArg[1] = "";
        }

        return [$tempArg[0] => $tempArg[1]];
    }
}
?>