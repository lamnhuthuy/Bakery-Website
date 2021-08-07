<?php

namespace App\Core;

class App
{
    private $controller = "Home";
    private $action = "Index";
    private $params = [];
    function __construct()
    {
        $url = $this->urlProcess();
        if (file_exists(CONT . DS . ucfirst($url[0]) . "Controller.php")) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        $this->controller = $this->controller . "Controller";
        require_once(CONT . DS  . $this->controller . ".php");

        $this->controller = new $this->controller;


        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->action = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }
    function urlProcess()
    {
        if (isset($_GET['url'])) {
            return explode("/", filter_var(trim($_GET['url'], "/")));
        } else {
            return [
                "Home",
                "Index"
            ];
        }
    }
}
