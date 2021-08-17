<?php

use App\Core\Controller;

class CategoryController extends Controller
{

    private $categoryModel;
    function __construct()
    {
        $this->categoryModel = $this->model("CategoryModel");
    }
    function index()
    {
        $data["cake"] = $this->categoryModel->getCakeByID_type($_GET["type"]);
        $data["name"] = $this->categoryModel->getNameById($_GET["type"]);
        $this->view("/cake/category", $data);
    }
}
