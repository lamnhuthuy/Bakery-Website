<?php

use App\Core\Controller;

class AccountController extends Controller
{

    private $userModel;
    function __construct()
    {
        $this->userModel = $this->model("UserModel");
    }
    function index()
    {
        $this->view('/shared/login');
    }
    function signUp()
    {
        $result = $this->userModel->register($_POST);
        if ($result) {
            $_SESSION["mes"] = "Register successfully. Please login now!";
        }
        header("Location: " . DOCUMENT_ROOT . "/Account");
    }
    function authenticate()
    {
        if (isset($_POST)) {
            $result = $this->userModel->authenticate($_POST);
            if ($result == true) {
                $user = $this->userModel->getByEmail($_POST['email']);
                $_SESSION['user'] = $user;
                header("Location: " . DOCUMENT_ROOT);
                return;
            } else {
                $_SESSION["message"] = "Your Email or password Incorrect";
                header("Location: " . DOCUMENT_ROOT . "/Account");
            }
        } else    header("Location: " . DOCUMENT_ROOT . "/Account");
    }
    function signOut()
    {
        unset($_SESSION['user']);
        unset($_SESSION["message"]);
        header("Location: " . DOCUMENT_ROOT);
        return;
    }
    function checkUser()
    {
        $index = $this->userModel->getByEmail($_POST["email"]);
        echo json_encode($index);
    }
}
