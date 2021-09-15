<?php

use App\Core\Controller;

class LoginController extends Controller
{
    private $userModel;

    function __construct()
    {
        $this->userModel = $this->model("UserModel");
    }
    function Index()
    {
        $this->view("/admin/login/index");
    }
    function checkAdmin()
    {
        if (isset($_POST["admin"]) && isset($_POST["password"]) && isset($_POST["submit"])) {
            $data['id'] = $_POST["admin"];
            $data['password'] = $_POST["password"];
            $result = $this->userModel->getAdmin($data);
            if ($result == true) {
                $_SESSION["admin"] = $this->userModel->getById($data["id"]);
                header("Location:" . DOCUMENT_ROOT . "/admin/home");
            } else {
                $_SESSION["messAdmin"] = "ID or Password incorrect";
                header("Location:" . DOCUMENT_ROOT . "/admin/Login");
            }
        }
    }
    function logOut()
    {
        unset($_SESSION["admin"]);
        unset($_SESSION["messAdmin"]);
        header("Location:" . DOCUMENT_ROOT . "/admin/Login");
    }
}
