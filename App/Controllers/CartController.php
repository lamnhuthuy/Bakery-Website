<?php

use App\Core\Controller;

class CartController extends Controller
{
    private $cartModel;
    function __construct()
    {
        $this->cartModel = $this->model("CartModel");
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
        $result = $this->cartModel->check();
        foreach ($result as $i => $cart) {
            print_r($cart);
        }
    }
}
