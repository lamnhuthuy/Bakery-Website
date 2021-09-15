<?php

use App\Core\Controller;

class CategoriesController extends Controller
{
    private $categoryModel;

    function __construct()
    {
        $this->categoryModel = $this->model("CategoryModel");
    }
    function index()
    {
        $data["category"] = $this->categoryModel->all();
        $this->view("/admin/category/index", $data);
    }
    function edit($id)
    {
        $category = $this->categoryModel->getCakeType($id);
        if (!$category) {
            header("Location: " . DOCUMENT_ROOT . "/admin/cakes");
        }
        $data["category"] =  $category;
        $this->view("/admin/category/edit", $data);
    }
    function create()
    {
        $data["category"] = $this->categoryModel->all();
        $this->view("/admin/category/create", $data);
    }
    function store()
    {

        if (!isset($_POST)) {
            header("Location: " . DOCUMENT_ROOT . "/admin");
        }
        $data = $_POST;
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];

        $duongdan = ROOT . DS . "public" . DS . "img" . DS . "categories";

        $data["image"] = "";
        if (isset($_FILES["image"])) {
            if ($_FILES["image"]['name'] != "") {
                $randomNum = time();
                $imageName = str_replace(' ', '-', strtolower($_FILES["image"]['name']));
                $imageExt = substr($imageName, strrpos($imageName, '.'));
                $imageExt = str_replace('.', '', $imageExt);
                $newImageName = $randomNum . '.' . $imageExt;
                move_uploaded_file($_FILES["image"]["tmp_name"], $duongdan . DS . $newImageName);
                $data["image"] = $newImageName;
            }
        }
        $result = $this->categoryModel->store($data);
        if ($result == true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = " Category created successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Category created  unsuccessfully.";
        }
        header("Location: " . DOCUMENT_ROOT . "/admin/Categories/create");
    }
    function update($id)
    {
        if (!isset($_POST)) {
            header("Location: " . DOCUMENT_ROOT . "/admin");
        }
        $data = $_POST;
        $data["id"] = $id;
        $data['name'] = $_POST['name'];
        $data['description'] = $_POST['description'];
        $duongdan = ROOT . DS . "public" . DS . "img" . DS . "categories";
        $data["image"] = $this->categoryModel->getCakeType($id)["image"];
        if (isset($_FILES["image"])) {
            if ($_FILES["image"]['name'] != "") {
                $randomNum = time();
                $imageName = str_replace(' ', '-', strtolower($_FILES["image"]['name']));
                $imageExt = substr($imageName, strrpos($imageName, '.'));
                $imageExt = str_replace('.', '', $imageExt);
                $newImageName = $randomNum . '.' . $imageExt;
                move_uploaded_file($_FILES["image"]["tmp_name"], $duongdan . DS . $newImageName);
                $oldImage = $data["image"];
                if ($data["image"] != "") {
                    unlink(ROOT . DS . "public" . DS . "img" . DS . "categories" . DS . $oldImage);
                }
                $data["image"] = $newImageName;
            }
        }

        $result = $this->categoryModel->update($data);
        if ($result == true) {
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = " Category updated  successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Category updated  unsuccessfully.";
        }
        header("Location: " . DOCUMENT_ROOT . "/admin/Categories/edit/" . $id);
    }
    function delete($id)
    {
        $cakeType = $this->categoryModel->getCakeType($id);
        $cake = $this->categoryModel->getCakeByID_type($id);
        foreach ($cake as $index => $value) {
            $data["image"][] = $this->categoryModel->getImage($value["id"]);
        }
        $result = $this->categoryModel->delete($id);

        if ($result === true) {
            if ($cakeType["image"] != "") {
                unlink(ROOT . DS . "public" . DS . "img" . DS . "categories" . DS . $cakeType["image"]);
            }
            foreach ($data["image"] as $index => $value) {
                for ($i = 1; $i <= 4; $i++) {
                    if ($value[$i - 1]["image"] != "") {
                        unlink(ROOT . DS . "public" . DS . "img" . DS . "cakes" . DS . $value[$i - 1]["image"]);
                    }
                }
            }
            $_SESSION["alert"]["status"] = "true";
            $_SESSION["alert"]["mes"] = "Category  deleted successfully.";
        } else {
            $_SESSION["alert"]["status"] = "false";
            $_SESSION["alert"]["mes"] = "Can't delete item because customers bought cakes have this category.";
        }
        header("Location:" . DOCUMENT_ROOT . "/admin/categories/index");
    }
}
