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
        if (strtolower($url[0]) == "admin") {
            unset($url[0]);
            if (!isset($_SESSION['admin']) && isset($url[1])) {
                if (strtolower($url[1]) != "login") {
                    $url[1] = "Login";
                    $url[2] = "index";
                }
            } else if (!isset($_SESSION['admin']) && !isset($url[1])) {
                $url[1] = "Login";
                $url[2] = "index";
            }

            if (isset($url[1])) {
                $GLOBALS['currentRoute'] = $url[1];
                if (file_exists(CONT . DS . "admin" . DS . ucfirst($url[1]) . "Controller.php")) {
                    $this->controller = ucfirst($url[1]);
                    unset($url[1]);
                }
            }
            $this->controller = $this->controller  . "Controller";
            require_once(CONT . DS . "admin" . DS  . $this->controller . ".php");
            $this->controller = new $this->controller;

            // assign action
            if (isset($url[2]) && method_exists($this->controller, $url[2])) {
                $this->action = $url[2];
                unset($url[2]);
            }
            // params
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->action], $this->params);
        } else {
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
    }
    function urlProcess()
    {
        if (isset($_GET['url'])) {
            $url = explode("/", filter_var(trim($_GET['url'], "/")));
            return $url;
        } else {
            return [
                "Home",
                "Index"
            ];
        }
    }
}
