<?php

namespace App\Core;

class Controller
{
    function model($model)
    {
        if (file_exists(MODEL . DS . $model . '.php')) {
            require_once(MODEL . DS . $model . '.php');
            return new $model;
        } else {
            die('Not found model: ' . $model);
        }
    }
    function view($view, $data = [])
    {

        if (file_exists(VIEW . DS . $view . '.php') && (strpos($view, "login") == false)) {
            $layout = "shared/layout";
        } elseif (file_exists(VIEW . DS . $view . '.php') && (strpos($view, "login") == true)) {
            $layout = "shared/login";
        } else  die('Not found view: ' . $view);
        require_once(VIEW . DS . $layout . '.php');
    }
}
