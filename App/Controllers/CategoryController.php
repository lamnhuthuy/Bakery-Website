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
        $data["type"] = $_GET["type"];
        $data["cake"] = $this->categoryModel->getCakeByID_type($_GET["type"]);
        $data["name"] = $this->categoryModel->getNameById($_GET["type"]);
        if (isset($_GET["sort"])) {
            $data["cake"] = $this->categoryModel->sort($_GET["type"], $_GET["sort"]);
            $this->view("/cake/category", $data);
            return;
        }
        $this->view("/cake/category", $data);
    }
}
