<?php

use App\Core\Controller;

class CartController extends Controller
{
    private $cartModel;
    private $cakeModel;
    function __construct()
    {
        $this->cartModel = $this->model("CartModel");
        $this->cakeModel = $this->model("CakeModel");
        $this->orderModel = $this->model("OrderModel");
    }
    function addToCart()
    {
        $result = $this->cartModel->addToCart($_POST);
        echo json_encode($result);
    }
    function amountInCart()
    {
        if (isset($_SESSION['user'])) {
            $amount = $this->cartModel->amountInCart($_SESSION['user']['id']);
            echo $amount;
        } else {
            echo 0;
        }
    }
    function index()
    {
        if (isset($_SESSION["user"])) {
            $Cake = $this->cartModel->getCakeOfUser($_SESSION['user']['id']);
            $data["amount"] = $this->cartModel->amountInCart($_SESSION['user']['id']);
            $data["total"] = 0;
            if ($Cake == false) {
                $data["cake"][] = [];
            } else {
                foreach ($Cake as $index => $value) {
                    $data["cake"][] = $this->cakeModel->getCakeByID($value["id_cake"]);
                    $data["amountCake"][] = $value["amount"];
                    $data["total"] += $value["amount"] * $data["cake"][$index]["sale"];
                }
            }
            $this->view("/cart/cart", $data);
        } else {
            $this->view("/cart/cart");
        }
    }
    function updateCart()
    {
        if (isset($_POST)) {
            $result = $this->cartModel->updateCart($_POST);
            echo json_encode($result);
        }
    }
    function deleteCart()
    {
        if (isset($_POST)) {
            $result = $this->cartModel->deleteCart($_POST);
            if ($result == true) {
                echo json_encode($this->cartModel->amountInCart($_POST["id_user"]));
            }
        }
    }
    function checkOut()
    {

        if ($this->cartModel->amountInCart($_SESSION['user']['id']) < 1) {
            $_SESSION["info"] = "no";
            header("Location: " . DOCUMENT_ROOT);
            return;
        } else {
            $allCake = $this->cartModel->getCakeOfUser($_SESSION['user']['id']);
            $data["total"] = 0;
            foreach ($allCake as $index => $value) {
                $data["cake"][] = $this->cakeModel->getCakeByID($value["id_cake"]);
                $data["amountCake"][] = $value["amount"];
                $data["total"] += $value["amount"] * $data["cake"][$index]["sale"];
            }
            $this->orderModel->orderProcess($data);
            $_SESSION["info"] = "yes";
            header("Location: " . DOCUMENT_ROOT);
        }
    }
}
