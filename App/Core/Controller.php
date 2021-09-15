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
        if (file_exists(VIEW . $view . '.php')) {
            if (strpos($view, "admin") == true) {
                $layout = "admin/shared/layout";
            } else if (strpos($view, "login") == true) {
                $layout = "shared/login";
            } else {
                $layout = "shared/layout";
            }
        } else  die('Not found view: ' . $view);
        require_once(VIEW . DS . $layout . '.php');
    }
}
