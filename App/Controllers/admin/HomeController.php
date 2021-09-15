<?php

use App\Core\Controller;

class HomeController extends Controller
{
    private $userModel;
    private $cakeModel;
    private $orderModel;
    private $categoryModel;
    function __construct()
    {
        $this->categoryModel = $this->model("CategoryModel");
        $this->userModel = $this->model("UserModel");
        $this->orderModel = $this->model("OrderModel");
        $this->cakeModel = $this->model("CakeModel");
    }
    function Index()
    {
        $data["cakes"] = $this->cakeModel->all();
        $data["orders"] = $this->orderModel->all();
        $data["users"] = $this->userModel->all();
        $data["category"] = $this->categoryModel->all();
        $this->view("/admin/home/index", $data);
    }
}
