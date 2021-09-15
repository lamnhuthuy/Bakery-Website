<?php

use App\Core\Controller;

class HomeController extends Controller
{
    private $cakeModel;
    private $categoryModel;
    private $bannerModel;

    function __construct()
    {
        $this->cakeModel = $this->model("CakeModel");
        $this->categoryModel = $this->model("CategoryModel");
        $this->bannerModel = $this->model("bannerModel");
    }
    function Index()
    {
        $data["category"] = $this->categoryModel->all();
        $data["banner"] = $this->bannerModel->all();
        $data["cake"] = $this->cakeModel->all();
        if (!isset($_GET["page"])) {
            $_GET["page"] = 1;
        }
        $data["page"] = $_GET["page"];
        $data["numberProduct"] = 12;
        $data["cakePerPage"] = $this->cakeModel->getCakeByPage($_GET["page"], $data["numberProduct"]);
        $data['bestSellers'][] =  $data["cake"][33];
        $data['bestSellers'][] =  $data["cake"][18];
        $data['bestSellers'][] =   $data["cake"][26];
        $data['bestSellers'][] =   $data["cake"][5];
        $data['bestSellers'][] =   $data["cake"][22];
        $data["pageCount"] = ceil(count($data["cake"]) / $data["numberProduct"]);
        $this->view("/home/index", $data);
    }
}
