<?php

use App\Core\Controller;

class HomeController extends Controller
{
    private $cakeModel;
    private $categoryModel;

    function __construct()
    {
        $this->cakeModel = $this->model("CakeModel");
        $this->categoryModel = $this->model("CategoryModel");
    }
    function Index()
    {
        $data["category"] = $this->categoryModel->all();
        $data["cake"] = $this->cakeModel->all();
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        $data["page"] = $_GET["page"];
        $data["numberProduct"] = 8;
        $data["cakePerPage"] = $this->cakeModel->getCakeByPage($_GET["page"], $data["numberProduct"]);
        $data['bestSellers'][] =  $data["cake"][2];
        $data['bestSellers'][] =  $data["cake"][5];
        $data['bestSellers'][] =   $data["cake"][9];
        $data['bestSellers'][] =   $data["cake"][1];
        $data['bestSellers'][] =   $data["cake"][7];
        $data["pageCount"] = ceil(count($data["cake"]) / $data["numberProduct"]);
        $this->view("/home/index", $data);
    }
}
